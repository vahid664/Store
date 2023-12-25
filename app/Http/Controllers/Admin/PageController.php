<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='صفحات ثابت سایت';
        $query=Page::with(['category','user'])->orderByDesc('id')->get();
        return view('admin.page.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='افزودن صفحات ثابت';
        return view('admin.page.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $this->validate($request,[
            'title_en' => 'required|min:2|max:255|unique:pages',
            'title' => 'required|min:2|max:255|unique:pages',
            'category_id' => 'required|numeric',
            'status' => 'required|numeric',
            'keywords' => 'nullable|min:3|max:75',
            'description' => 'nullable|min:3|max:255',
            'text' => 'required|min:3',
        ]);
        Page::create(array_merge(['user_id' => Auth::user()->id],$request->all()));
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
        $query=Page::findOrFail($id);
        $title=' ویرایش '.$query->title;
        return view('admin.page.edit',compact('title','query'));
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
        $find=Page::findOrFail($id);
        $this->validate($request,[
            'title_en' => 'required|min:2|max:255',
            'title' => 'required|min:2|max:255',
            'category_id' => 'required|numeric',
            'status' => 'required|numeric',
            'keywords' => 'nullable|min:3|max:75',
            'description' => 'nullable|min:3|max:255',
            'text' => 'required|min:3',
        ]);
        $find->update($request->all());
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
        $find=Page::findOrFail($id)->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
