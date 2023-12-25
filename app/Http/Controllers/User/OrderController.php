<?php

namespace App\Http\Controllers\User;

use App\Factor;
use App\FactorOff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query=Factor::where('user_id',Auth::user()->id)
            ->with(['product','user'])
            ->orderByDesc('id')->get();
        if ($request->view=='on-delivery') {
            $title='در حال تحویل';
          /*  $query=Factor::where('user_id',Auth::user()->id)
                ->with(['product','user'])
                /*->where('status',1)
                ->where('delivery',0)
                ->orderByDesc('id')->get();*/
            return view('user.order.index',compact('title','query'));
        }
        elseif ($request->view=='delivered'){
            $title='تحویل داده شده';
           /* $query=Factor::where('user_id',Auth::user()->id)
                ->with(['product','user'])
             /*   ->where('status',1)
                ->where('delivery',1)
                ->orderByDesc('id')->get();*/
            return view('user.order.delivered',compact('title','query'));
        }
        elseif ($request->view=='unsuccessful'){
            $title='پرداخت ناموفق';
           /* $query=Factor::where('user_id',Auth::user()->id)
                ->with(['product','user'])
               /* ->where('status',0)
                ->orderByDesc('id')->get();*/
            return view('user.order.unsuccessful',compact('title','query'));
        }
        else{
            $title='در حال تحویل';
          /*  $query=Factor::where('user_id',Auth::user()->id)
                ->with(['product','user'])
                /*->where('status',1)
                ->where('delivery',0)
                ->orderByDesc('id')->get();*/
            return view('user.order.index',compact('title','query'));
        }
        //return $query;

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
        $query=Factor::findOrFail($id);

        $off=FactorOff::where('factor_id',$id);
        $title=' جزییات سفارش 000'.$query->id;
        return view('user.order.show',compact('title','query','off'));
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
