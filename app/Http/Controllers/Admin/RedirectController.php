<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='لیست ریدایرکت سئو';
        $query=Redirect::with(['user'])->orderByDesc('id')->get();
        return view('admin.redirect.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='افزودن ریدایرکت';
        return view('admin.redirect.create',compact('title'));
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
            'before' => 'required|min:2|max:255|unique:redirects',
            'after' => 'required|min:2|max:255',
            'type' => 'required|numeric',
        ]);
        Redirect::create(array_merge($request->all(),['user_id' => Auth::user()->id]));
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
        $query=Redirect::findOrFail($id);
        $title=' ویرایش '.$query->title;
        return view('admin.redirect.edit',compact('title','query'));
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
        $this->validate($request,[
            'before' => 'required|min:2|max:255',
            'after' => 'required|min:2|max:255',
            'type' => 'required|numeric',
        ]);
        $find=Redirect::findOrFail($id);
        $find->update($request->all());
        return redirect()->back()->with('status','ویرایش موفق اطلاعات');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find=Redirect::findOrFail($id);
        $find->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
