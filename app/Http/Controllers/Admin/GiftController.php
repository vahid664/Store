<?php

namespace App\Http\Controllers\Admin;

use App\Gift;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='هدیه';
        $query=Gift::orderByDesc('id')->paginate(1000);
        //return $query;
        return view('admin.gift.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='ثبت هدیه';
        return view('admin.gift.create',compact('title'));
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
            'title' => 'nullable|min:2|max:255',
            'text' => 'nullable|min:2|max:255',
            'product_id' => 'required|numeric|unique:gifts',
            'count' => 'required|numeric',
            'floor_price_basket' => 'required|numeric',
            'date_start' => 'required|date',
            'date_end' => 'nullable|date|after:Start',
            'status' => 'required|numeric',
        ]);

        Gift::create(array_merge($request->all(),['user_id'=> Auth::user()->id]));
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
        $query=Gift::findOrFail($id);
        $title=' ویرایش '.$query->title;
        return view('admin.gift.edit',compact('title','query'));
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
        $gift=Gift::findOrFail($id);
        $this->validate($request,[
            'title' => 'nullable|min:2|max:255',
            'text' => 'nullable|min:2|max:255',
            'product_id' => 'required|numeric',
            'count' => 'required|numeric',
            'floor_price_basket' => 'required|numeric',
            'date_start' => 'required|date',
            'date_end' => 'nullable|date|after:Start',
            'status' => 'required|numeric',
        ]);
        $gift->update($request->all());
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
        $find=Gift::findOrFail($id)->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
