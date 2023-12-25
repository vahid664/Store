<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductColor;
use App\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //session()->forget('basket');
        //return session('basket');
        $title='سبد خرید';
        if(session('basket'))
        {
            return view('visitor.cart.index',compact('title'));
        }
        return view('visitor.cart.empty',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function color($colors,$size)
    {
        $rang='--';
        foreach ($colors as $color)
        {
            $excolor=explode('|',$color);
            if(isset($excolor[1]) && $excolor[1] == $size)
            {
                $rang=$excolor[0];
            }
        }
        return $rang;
    }
    public function store(Request $request)
    {
        $product=Product::findOrFail($request->id);
        if($product->price_type == 3)
        {
            return redirect(route('cart.index'));
        }
        $sehat_size=0;
        if (isset($request->entity) && count($request->entity))
        {
            $basket=session()->get('basket');
            foreach ($request->entity as $value)
            {
                $explode=explode('|',$value);
                if (isset($explode[1]))
                {
                    $find_size=ProductSize::findorFail($explode[1]);
                    if ($find_size->entity <=0 )
                    {
                        return redirect(route('cart.index'))->withErrors('موجودی این محصول در انبار تمام شده است.');
                    }
                    if(!$basket)
                    {
                        $basket[$find_size->id]=[
                            "product" => $request->id,
                            "title" => $product->title,
                            "quantity" => $explode[0],
                            "price" => $find_size->price,
                            "price_type" => $find_size->price_discount  > 0 ? 2 : 1,
                            "price_percent" => $find_size->price_discount,
                            "pic" => $product->picfirst != null ? $product->picfirst->link : '',
                            "color" => $this->color($request->color,$find_size->id),
                            "size" => $find_size->title
                        ];

                    }else{
                        if(!isset($basket[$find_size->id]))
                        {
                            $basket[$find_size->id]=[
                                "product" => $request->id,
                                "title" => $product->title,
                                "quantity" => $explode[0],
                                "price" => $find_size->price,
                                "price_type" => $find_size->price_discount  > 0 ? 2 : 1,
                                "price_percent" => $find_size->price_discount,
                                "pic" => $product->picfirst != null ? $product->picfirst->link : '',
                                "color" => $this->color($request->color,$find_size->id),
                                "size" => $find_size->title
                            ];
                        }else{
                            $basket[$find_size->id]['quantity']+=$explode[0];
                            if ($basket[$find_size->id]['color'] != $this->color($request->color,$find_size->id))
                            {
                                $basket[$find_size->id]['color'].= ' - '.$this->color($request->color,$find_size->id);
                            }
                        }
                    }
                }
                else{
                    $sehat_size++;
                }
            }
        }
        if($sehat_size == count($request->entity))
        {
            return redirect()->back()->withErrors('سایزبندی درستی برای محصول انتخاب نشده است.');
        }
        session()->put('basket',$basket);
        $this->SumKala();
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_size=ProductSize::findOrFail($id);
        if($product_size->product->price_type == 3)
        {
            return redirect(route('cart.index'));
        }

        $basket=session()->get('basket');

        if(!isset($basket[$id]))
        {
            return redirect()->back()->withErrors('محصولی با درخواست شما در سبد خریدتان موجود نیست.');
        }else{
            $basket[$id]['quantity']++;
        }

        session()->put('basket',$basket);
        $this->SumKala();
        return redirect()->back();
    }

    public function SumKala()
    {
        $basket_entity=0;
        $basket_price=0;
        foreach (session('basket') as $item)
        {
            $basket_entity+=$item['quantity'];
            if ($item['price_type'] == 1)
            {
                $basket_price+=$item['price'] * $item['quantity'];
            }
            elseif ($item['price_type'] == 2)
            {
                $basket_price+= ($item['price'] - ($item['price']*($item['price_percent']/100))) * $item['quantity'];
            }
        }
        session()->put('basket_entity',$basket_entity);
        session()->put('basket_price',$basket_price);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    public function delete(Request $request)
    {
        //return $request->all();
        //$product=Product::findOrFail($request->id);
        $size=ProductSize::findOrFail($request->id);
        $id=$request->id;
        $basket=session()->get('basket');
        if (isset($basket[$id]))
        {
            if($basket[$id]['quantity'] > 1)
            {
                $basket[$id]['quantity']--;
            }
            else
            {
                unset($basket[$id]);
            }
        }
        session()->put('basket',$basket);
        $this->SumKala();
        return redirect(route('cart.index'));
    }

    public function add(Request $request)
    {
        //return response()->json($request->all());
        $now=Carbon::now()->format('Y/m/d');
        $product=Product::with(['awesome' => function($q) use ($now){
            return $q->where('date_start','<=',$now)
                ->where('date_end','>=',$now);
        }])->findOrFail($request->id);
        $flag_awsome=1;
        if($product->awesome != null)
        {
            $end=Carbon::create($product->awesome->date_end_explode[0],$product->awesome->date_end_explode[1],$product->awesome->date_end_explode[2],$product->awesome->hour_end,0,0);
            if($end < Carbon::now()->format('Y-m-d H:00:00'))
            {
                $flag_awsome=0;
            }
        }
        else{
            $flag_awsome=0;
        }
        $id=$request->id;
        if($product->price_type == 3)
        {
            return response()->json('محصول مورد نظر قابل خرید نمی باشد',400);
        }
        $basket=session()->get('basket');
        if(!$basket)
        {
            $basket=[
                $id => [
                    'title' => $product->title,
                    "quantity" => 1,
                    "price" => $flag_awsome  == 1 ?  $product->awesome->price : $product->price,
                    "price_type" => $flag_awsome  == 1 ? 2 : $product->price_type,
                    "price_percent" => $flag_awsome  == 1 ? $product->awesome->price_percent : $product->price_percent,
                    "pic" => $product->picfirst != null ? $product->picfirst->link : '',
                ]
            ];
        }
        elseif (isset($basket[$id]))
        {
            $basket[$id]['quantity']++;
        }
        else{
            $basket[$id] = [
                'title' => $product->title,
                "quantity" => 1,
                "price" => $flag_awsome  == 1 ?  $product->awesome->price : $product->price,
                "price_type" => $flag_awsome  == 1 ? 2 : $product->price_type,
                "price_percent" => $flag_awsome  == 1 ? $product->awesome->price_percent : $product->price_percent,
                "pic" => $product->picfirst != null ? $product->picfirst->link : '',
            ];
        }
        session()->put('basket',$basket);
        $this->SumKala();
        return response()->json('add');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return $id;
        $basket=session()->get('basket');
        if(isset($basket[$id]))
        {
            unset($basket[$id]);
            session()->put('basket',$basket);
        }
        $this->SumKala();
        return redirect()->back();
    }
}
