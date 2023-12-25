<?php

namespace App\Http\Controllers\User;

use App\Factor;
use App\FactorGift;
use App\FactorOff;
use App\FactorPeyk;
use App\FactorProduct;
use App\Gift;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Off;
use App\Peyk;
use App\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class BuyController extends Controller
{
    public function payment(Request $request)
    {
        $this->validate($request,[
            'comment' => 'nullable|min:2|max:400|string'
        ]);
        $basket=session()->get('basket');
        $price_post=Helper::PriceSend();
        //return $price_post;
        $price_off=0;
        if(session('off'))
        {
            if(session('off')->type_off == 1)
            {
                $price_off=session('off')->price;
            }
            else
            {
                $price_off=session()->get('basket_price')*(session('off')->price_percent/100);
            }
        }
        if (session('PricePerson')){
            $price_online = ((session()->get('basket_price') - $price_off) *0.1) + $price_post;
        }else{
            $price_online = (session()->get('basket_price') - $price_off) + $price_post;
        }
        //return session('SendPrice');
        //return (session()->get('basket_price') - $price_off) +$price_post;
        $factor=Factor::create([
            'user_id' => Auth::user()->id,
            'price' => (session()->get('basket_price') - $price_off) +$price_post,
            'price_send' => $price_post,
            'description' => Auth::user()->address_first->province.' | '.Auth::user()->address_first->city.' | '.
                Auth::user()->address_first->address.' | '.
                Auth::user()->address_first->mobile.' | '.Auth::user()->address_first->name_family
                .' | '.Auth::user()->address_first->post_code,
            'status' => 0,
            'comment' => $request->comment != '' ? $request->comment : '',
            'price_online' => $price_online,
            'send_type' => session('SendType')
        ]);

        if(isset(session('SendPrice')->price))
        {
            $peyk=Peyk::findOrFail(session('SendPrice')->id);
            $peyk->decrement('count');
            FactorPeyk::create([
                'factor_id' => $factor->id,
                'peyk_id' => session('SendPrice')->id,
                'date' => session('SendPrice')->date,
                'time' => session('SendPrice')->time_start.' - '.session('SendPrice')->time_end,
                'price' => session('SendPrice')->price,

            ]);
        }

        if(session('gift')){
            FactorGift::create([
                'factor_id' => $factor->id,
                'user_id' => Auth::user()->id,
                'gift_id' => session('gift')->id
            ]);
        }

        if(session('off')){
            $off=Off::findOrFail(session('off')->id);
            FactorOff::create([
                'factor_id' => $factor->id,
                'user_id' => Auth::user()->id,
                'off_id' => session('off')->id,
                'code' => session('off')->code,
                'type_off' => session('off')->type_off,
                'price' => session('off')->price,
                'price_percent' => session('off')->price_percent,
            ]);
            $off->increment('count_use');
        }
        foreach ($basket as $item)
        {
            $p=FactorProduct::create([
                'factor_id' => $factor->id,
                'product_id' => $item['product'],
                'price_type' => $item['price_type'],
                'price' => $item['price'],
                'price_percent' => $item['price_percent'],
                'count' => $item['quantity'],
                'size' => $item['size'],
                'color' => $item['color'],
            ]);
            /*if (isset($item['color']) && $item['color'] != null)
            {
                $color='';
                foreach ($item['color'] as $val=>$value)
                {
                    $product_color=ProductColor::find($val);
                    if (isset($product_color->id))
                    {
                        $color.=' رنگ '.$product_color->title.'  ('.$product_color->title_factory.') = '.$value.'<br>';
                    }
                }
                $p->update(['color' => $color]);
            }*/
        }
        $invoice= new Invoice();
        //dd(intval(session('basket_price')));
//        $invoice->amount(intval((session('basket_price') - $price_off) +$price_post));
        $invoice->amount(intval($price_online));
        $invoice->detail('detailName','صورتحساب پرداخت محصول');
        $invoice->via('sadad');
        return Payment::purchase($invoice,
            function($driver, $transactionId) use ($factor){
                $factor->update(['trans_id' => $transactionId]);
            }
        )->pay()->render();
    }
    public function verify(Request $request)
    {
        $pay=Factor::where('trans_id',$request->token)->firstOrFail();
        $pay->update(['ntracking' => $request->OrderId]);
        $state=(int) $request->ResCode;
        if($state != 0)
        {
            session()->forget(['gift']);
            return redirect(url('buy/factor'))->with('status_error','عدم موفقیت در پرداخت، لطفا لحظاتی بعد دوباره اقدام به عملیات پرداخت نمایید.');
        }
        elseif($state == 0)
        {
            try {
                $receipt = Payment::amount((int)$pay->price)->transactionId($pay->trans_id)->verify();
                $pay->update(['refrence_id' => $receipt->getReferenceId()]);
                $pay->update(['status' => 1]);
                foreach ($pay->product as $value)
                {
                    $value->product_details->decrement('entity');
                }
                if(session('gift'))
                {
                    $gift=Gift::where('id',session('gift')->id)->first();
                    if(isset($gift->id))
                    {
                        $gift->increment('count_use');
                    }
                }

                session()->forget(['basket','basket_entity','basket_price','off','gift']);
                Helper::smsBuy($pay);
            } catch (InvalidPaymentException $exception) {
                //echo $exception->getMessage();
                return redirect(url('buy/factor'))->with('status_error','کاربر گرامی، امکان ثبت هیچ گونه عملیات پرداختی وجود ندارد. شما می توانید از قسمت پشتیبانی اقدام به ارسال تیکت کنید.');
            }
            return redirect(url('buy/factor'))->with('status_success','موفقیت در پرداخت، می توانید فایل خود را دانلود کنید');
        }
        else
        {
            return redirect(url('buy/factor'))->with('status_error','کاربر گرامی، امکان ثبت هیچ گونه عملیات پرداختی وجود ندارد. شما می توانید از قسمت پشتیبانی اقدام به ارسال تیکت کنید.');
        }
    }
    public function factor()
    {
        $title='فاکتور خرید';
        $query=Factor::where('user_id',Auth::user()->id)->with(['product','user'])->orderByDesc('id')->first();
        if($query->status==0)
        {
            return view('user.buy.nok',compact('query','title'));
        }
        return view('user.buy.factor',compact('query','title'));
    }

    public function info_send()
    {
        $title='اطلاعات ارسال';
        //dd(session('off'));
        return view('user.buy.index',compact('title'));
    }

    public function TypeSend()
    {
        $now=Carbon::now()->format('Y/m/d');
        $week=Carbon::now()->addDay(7)->format('Y/m/d');
        $date=Peyk::whereDate('date','>=',$now)
            ->whereDate('date','<=',$week)
            ->orderBy('date')
            ->get()->unique('date');

        $gift=[];
        $basket_Product=array_keys(session()->get('basket'));
        if(session()->get('basket_price'))
        {
            $gift=Gift::whereDate('date_start','<=',$now)
                ->whereDate('date_end','>=',$now)
                ->whereNotIn('product_id',$basket_Product)
                ->where('status',1)
                ->where('floor_price_basket','<=',session()->get('basket_price'))
                ->get();
        }
        //return $gift;
        $title='نوع ارسال مرسوله';
        return view('user.buy.type_send',compact('title','date','gift'));
    }
}
