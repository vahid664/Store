<?php

namespace App\Http\Controllers\User;

use App\Gift;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GiftController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $now=Carbon::now()->format('Y/m/d');
        $query=Gift::whereDate('date_start','<=',$now)
            ->where('id',$id)
            ->whereDate('date_end','>=',$now)
            ->where('status',1)
            ->where('floor_price_basket','<=',session()->get('basket_price'))
            ->first();
        if(!isset($query->id))
        {
            return redirect()->back()->withErrors('هدیه انتخابی یافت نشد.');
        }
        if($query->count_use >= $query->count)
        {
            return redirect()->back()->withErrors('هدیه مورد نظر تمام شده است.');
        }
        session()->put('gift',$query);
        return redirect()->back()->with('status','هدیه مورد نظر برای شما فعال شد.');
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
