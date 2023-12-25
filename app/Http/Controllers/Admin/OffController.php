<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Off;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return 'index';
        $title='تخفیفات';
        $query=Off::orderByDesc('id')->paginate(1000);
        //return $query;
        return view('admin.off.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='ثبت کد تخفیف';
        return view('admin.off.create',compact('title'));
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
            'code' => 'required|min:2|max:255|unique:offs',
            'title' => 'required|min:2|max:255|unique:offs',
            'count' => 'required|numeric',
            'type_off' => 'required|numeric',
            'price' => 'nullable|numeric',
            'price_percent' => 'nullable|numeric',
            'price_factor' => 'nullable|numeric',
            'date_start' => 'required|date',
            'date_end' => 'nullable|date|after:Start',
            'status' => 'required|numeric',
        ]);

        Off::create(array_merge($request->all(),['user_id'=> Auth::user()->id]));
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
        $query=Off::findOrFail($id);
        $title=' ویرایش '.$query->title;
        return view('admin.off.edit',compact('title','query'));
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
        $off=Off::findOrFail($id);
        $this->validate($request,[
            'code' => 'required|min:2|max:255',
            'title' => 'required|min:2|max:255',
            'count' => 'required|numeric',
            'type_off' => 'required|numeric',
            'price' => 'nullable|numeric',
            'price_percent' => 'nullable|numeric',
            'price_factor' => 'nullable|numeric',
            'date_start' => 'required|date',
            'date_end' => 'nullable|date|after:Start',
            'status' => 'required|numeric',
        ]);
        $off->update($request->all());
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
        $find=Off::findOrFail($id)->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
