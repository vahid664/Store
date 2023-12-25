<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='برندها';
        $query=Brand::all();
        //return $query;
        return view('admin.brand.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='ثبت برند';
        return view('admin.brand.create',compact('title'));
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
            'title' => 'required|min:2|max:255|unique:brands',
            'title_en' => 'required|min:2|max:255|unique:brands',
            'pic' => 'required|mimes:jpg,jpeg,png,gif|max:10240',
            'pic_alt' => 'required|min:2|max:255',
            'keywords' => 'nullable|min:2|max:255',
            'description' => 'nullable|min:2|max:255',
            'status' => 'required|numeric',
            'color' => 'required',
            'text' => 'nullable|min:2|max:80000',
        ]);

        $brand=Brand::create(array_merge($request->except('pic'),['user_id' => Auth::user()->id]));
        if($request->hasFile('pic'))
        {
            $destination= base_path().'/public/upload/brand/'.date('Y').'/'.date('m');
            if(!is_dir($destination))
            {
                mkdir($destination,0777,true);
            }
            $destination=$destination.'/';
            $filename=rand(1111111,99999999);
            $file=$request->file('pic');
            $file->move($destination,$filename.'.'.$request->pic->getClientOriginalExtension());
            $brand->update(['pic' => '/upload/brand/'.date('Y').'/'.date('m').'/'.$filename.'.'.$request->pic->getClientOriginalExtension()]);
        }

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
        $query=Brand::findOrFail($id);
        $title=' ویرایش '.$query->title;
        return view('admin.brand.edit',compact('title','query'));
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
        $brand=Brand::findOrFail($id);
        $this->validate($request,[
            'title' => 'required|min:2|max:255',
            'title_en' => 'required|min:2|max:255',
            'pic' => 'nullable|mimes:jpg,jpeg,png,gif|max:10240',
            'pic_alt' => 'nullable|min:2|max:255',
            'keywords' => 'nullable|min:2|max:255',
            'description' => 'nullable|min:2|max:255',
            'status' => 'required|numeric',
            'color' => 'required',
            'text' => 'nullable|min:2|max:80000',
        ]);

        $brand->update($request->except('pic'));
        if($request->hasFile('pic'))
        {
            $destinationbefore = base_path() . '/public/'.$brand->pic;
            //return $destinationbefore;
            if(file_exists($destinationbefore) && $brand->file != '')
            {
                unlink($destinationbefore);
            }
            $destination= base_path().'/public/upload/brand/'.date('Y').'/'.date('m');
            if(!is_dir($destination))
            {
                mkdir($destination,0777,true);
            }
            $destination=$destination.'/';
            $filename=rand(1111111,99999999);
            $file=$request->file('pic');
            $file->move($destination,$filename.'.'.$request->pic->getClientOriginalExtension());
            $brand->update(['pic' => '/upload/brand/'.date('Y').'/'.date('m').'/'.$filename.'.'.$request->pic->getClientOriginalExtension()]);
        }

        return redirect()->back()->with('status','ثبت موفق اطلاعات');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find=Brand::findOrFail($id);
        $find->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
