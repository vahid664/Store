<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Peyk;
use Illuminate\Http\Request;
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
        $title='پیک';
        $query=Peyk::orderByDesc('date')->paginate(2000);
        //return $query;
        return view('admin.peyk.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='ثبت پیک';
        return view('admin.peyk.create',compact('title'));
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
            'date' => 'required|date',
            'count' => 'required|numeric',
            'time_start' => 'required|numeric',
            'time_end' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $check=Peyk::where('date',$request->date)
            ->where(function ($q) use ($request){
                return $q->where('time_start',$request->time_start)
                    ->orWhere('time_end',$request->time_end);
            })
            ->count();
        if($check > 0)
        {
            return redirect()->back()->withErrors('این تایم قبلا ثبت شده است')->withInput();
        }
        Peyk::create(array_merge($request->all(),['user_id'=> Auth::user()->id]));
        return redirect()->back()->with('status','ثبت موفق اطلاعات');
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
        $query=Peyk::findOrFail($id);
        $title=' ویرایش '.$query->date.' / '.$query->time_start.' - '.$query->time_end;
        return view('admin.peyk.edit',compact('title','query'));
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
        $peyk=Peyk::findOrFail($id);
        $this->validate($request,[
            'date' => 'required|date',
            'count' => 'required|numeric',
            'time_start' => 'required|numeric',
            'time_end' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        $peyk->update($request->all());
        return redirect()->back()->with('status','به روز رسانی موفق اطلاعات');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find=Peyk::findOrFail($id)->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
