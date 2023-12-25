<?php

namespace App\Http\Controllers\Admin;

use App\Factor;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportFactorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='گزارش گیری رفتار خرید';
        $date=verta();
        return view('admin.report_factor.index',compact('title','date'));
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
        $query=Factor::active();
        $title='';
        if (isset($request->start_date) && !isset($request->end_date))
        {
            $input=Helper::toGro($request->start_date);
            $title.='مشتریانی که در بازه '.$input[0].' تا '.$input[1].' خرید انجام داده اند ';
            $query=Factor::whereBetween('created_at',$input);
        }
        elseif (!isset($request->start_date) && isset($request->end_date))
        {
            $input=Helper::toGro($request->end_date);
            $title.='مشتریانی که در بازه '.$input[0].' تا '.$input[1].' خرید انجام نداده اند ';
            $query=Factor::whereNotBetween('created_at',$input);
        }
        elseif(isset($request->start_date) && isset($request->end_date)){
            $input_start=Helper::toGro($request->start_date);
            $input_end=Helper::toGro($request->end_date);
            $title.='مشتریانی که در بازه '.$input_start[0].' تا '.$input_start[1].' خرید انجام داده اند ';
            $title.='مشتریانی که در بازه '.$input_end[0].' تا '.$input_end[1].' خرید انجام نداده اند ';
            $query=Factor::whereBetween('created_at',$input_start)->whereNotBetween('created_at',$input_end);
        }
        else{
            return redirect()->back()->withErrors('هیچ انتخابی انجام نشده است.');
        }
        $query=$query->orderByDesc('id')->paginate(2000);
        //return $query;
        return view('admin.report_factor.show',compact('query','title'));
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
