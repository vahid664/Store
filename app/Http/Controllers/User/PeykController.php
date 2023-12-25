<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Peyk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PeykController extends Controller
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

        if (session("PricePerson")){
            session()->pull('PricePerson');
        }
        if (session("SendType")){
            session()->pull('SendType');
        }


        $this->validate($request,[
            'type' => 'required|numeric|between:1,4',
        ]);
        // type => 1 peyk - 2 post - 3 barbari - 4 tipoxs


        $type = $request->type;
        session()->put('SendType' , $type);

        if ($request->type == 4){
            $this->validate($request,[
                'type_payment' => 'required|numeric|between:1,2',
            ]);
        }
        if($request->type == 1)
        {

            if(!isset($request->time))
            {
                return redirect()->back()->withErrors('تایمی برای پیک انتخاب نشده است.');
            }
            $find=Peyk::select('id','date','time_start','time_end','price')->findOrFail($request->time);
            session()->put('SendPrice',$find);
        }
        elseif ($request->type == 3 ){
            session()->put('SendPrice' , 0);
        }
        elseif ($request->type == 4 )
        {
            if ($request->type_payment == 1)
            {

                session()->put('SendPrice' , 0);

            }elseif (session('basket_price') >=2000000 )
            {
                session()->put('PricePerson', 1);
                session()->put('SendPrice' , 0);

            }else{
                return redirect()->back()->withErrors('برای خریدهای کمتر از 2 میلیون تومان  پرداخت در محل امکان پذیر نمیباشد.');
            }

        }

        return redirect()->back()->with('status','نوع ارسال برای شما ثبت شد اقدام به پرداخت نمایید.');
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
