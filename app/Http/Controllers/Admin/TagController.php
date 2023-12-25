<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='لیست تگ های سایت';
        $query=Tag::with(['product_rel','user'])->get();
        return view('admin.tag.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='افزودن تگ';
        return view('admin.tag.create',compact('title'));
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
            'title' => 'required|min:2|max:255|unique:tags',
            'title_en' => 'required|min:2|max:255|unique:tags',
            'text' => 'nullable|min:2',
        ]);

        Tag::create(array_merge($request->all(),['user_id' => Auth::user()->id]));
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
        $query=Tag::findOrFail($id);
        $title=' ویرایش '.$query->title;
        return view('admin.tag.edit',compact('title','query'));
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
            'title' => 'required|min:2|max:255',
            'title_en' => 'required|min:2|max:255',
            'text' => 'nullable|min:2',
        ]);
        $find=Tag::findOrFail($id);
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
        $find=Tag::findOrFail($id);
        $find->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
