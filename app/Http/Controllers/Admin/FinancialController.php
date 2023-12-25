<?php

namespace App\Http\Controllers\Admin;

use App\Factor;
use App\FactorOff;
use App\FactorProductReturned;
use App\Http\Controllers\Controller;
use Carbon\CarbonPeriod;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $request->all();
        $title='گزارش مالی 30 روز گذشته';
        $now=Carbon::now()->subDay(30)->format('Y/m/d');
        if(isset($request->start_date))
        {
            $this->validate($request,[
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:Start',
                'status' => 'required|numeric',
            ]);
            $title='گزارش مالی براساس بازه زمانی';
            $now=$request->start_date;
            $data=[];
            $period=CarbonPeriod::create($request->start_date,$request->end_date);
            $i=0;
            foreach ($period as $value)
            {
                $query_time=Factor::whereDate('created_at',$value->format('Y/m/d'));
                if(isset($request->status))
                {
                    $query_time->where('status',$request->status);
                }
                $query_count=$query_time->count();
                $query_price_all_time=$query_time->sum('price');
                $query_price_send_time=$query_time->sum('price_send');
                $query_id_factor=$query_time->get()->pluck('id')->toArray();
                $query_returned_sum=FactorProductReturned::whereIn('factor_id',$query_id_factor)
                    ->where('status',1)->sum('price');
                $data[$i]=[
                    'time' => $value->format('Y/m/d'),
                    'all' => $query_price_all_time ,
                    'send' => $query_price_send_time,
                    'count' => $query_count,
                    'returned' => $query_returned_sum
                ];
                $i++;
            }
        }
        else
        {
            $data=[];
            for($i=30;$i>=0;$i--){
                $time=Carbon::now()->subDay($i)->format('Y/m/d');
                $query_time=Factor::whereDate('created_at',$time)->where('status',1);
                $query_count=$query_time->count();
                $query_price_all_time=$query_time->sum('price');
                $query_price_send_time=$query_time->sum('price_send');
                $query_id_factor=$query_time->get()->pluck('id')->toArray();
                $query_returned_sum=FactorProductReturned::whereIn('factor_id',$query_id_factor)
                    ->where('status',1)->sum('price');
                $data[$i]=[
                    'time' => $time,
                    'all' => $query_price_all_time ,
                    'send' => $query_price_send_time,
                    'count' => $query_count,
                    'returned' => $query_returned_sum
                ];
            }
        }
        $query=Factor::whereDate('created_at','>=',$now);
        if(isset($request->end_date))
        {
            $query->whereDate('created_at','<=',$request->end_date);
            $query->where('status',$request->status);
        }
        else{
            $query->where('status',1);
        }
        $query_price_all=$query->sum('price');
        $query_price_send=$query->sum('price_send');
        $query=$query->orderByDesc('id')->get();
        $query_returned=FactorProductReturned::whereIn('factor_id',$query->pluck('id')->toArray())
            ->where('status',1)->sum('price');
        //return $query_returned;
       /* $query_off=FactorOff::whereIn('factor_id',$query->pluck('id'));
        $discount_price=$query_off->where('type_off',1)->sum('price');
        $discount_percent=$query_off->where('type_off',2)->sum('price');
        return $discount_percent;*/

        return view('admin.financial.index',
            compact('title','query','query_price_all','query_price_send','data','query_returned'));
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
        $title='گزارش محصولات خرید موفق در تاریخ'. new Verta($id);
        $query=Factor::whereDate('created_at',$id)->where('status',1)->with(['product' => function ($q){
            return $q->count() > 0;
        }])->orderByDesc('id')->get();
        //return $query;
        return view('admin.financial.show',compact('title','query'));
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
