<?php

namespace App\Http\Controllers\User;

use App\FactorOff;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Off;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DiscountContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $this->validate($request,[
            'code' => 'required|min:2'
        ]);
        $code=Helper::number_persian_to_latin($request->code);
        $now=Carbon::now()->format('Y/m/d');
        $off=Off::where('code',$code)
            ->whereDate('date_start','<=',$now)
            ->whereDate('date_end','>=',$now)
            /*->whereRaw('count_use < count')*/
            ->where('status',1)
            ->select('id','title','code','type_off','price','price_percent','price_factor','count_use','count')
            ->first();
         //return $off;
        //return session('basket_price');
        if(!isset($off->id))
        {
            return redirect()->back()->withErrors('کد تخفیفی شما یافت نشد');
        }

        if($off->count_use >= $off->count)
        {
            return redirect()->back()->withErrors('کد تخفیفی مورد نظر تمام شده است.');
        }

        //return intval($off->price_factor);
        if(intval(session('basket_price')) < intval($off->price_factor))
        {
            $m='کد تخفیفی مورد نظر برای سبد خرید با مبلغ '. $off->price_factor.' امکان فعال شدن دارد. ';
            return redirect()->back()->withErrors($m);
        }

        $count_use=FactorOff::where('user_id',Auth::user()->id)
            ->where('code',$code)->count();
        if($count_use > 0)
        {
            return redirect()->back()->withErrors('شما یک بار از این کد تخفیفی استفاده کرده اید.');
        }
        session()->put('off',$off);
        return redirect()->back()->with('status','کد تخفیف برای شما ثبت شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
