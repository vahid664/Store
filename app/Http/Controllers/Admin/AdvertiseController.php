<?php

namespace App\Http\Controllers\Admin;

use App\Advertise;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='لیست بنرهای تبلیغی سایت';
        $query=Advertise::orderBy('sort')->get();
        return view('admin.advertise.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='ثبت بنر تبلیغی سایت';
        return view('admin.advertise.create',compact('title'));
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
            'title_en' => 'required|min:2|max:255',
            'title' => 'required|min:2|max:255',
            'pic' => 'required|mimes:jpg,jpeg,png,gif|max:10240',
            'pic_alt' => 'required|min:2|max:255',
            'url' => 'required|url',
            'description' => 'nullable|min:2|max:255',
            'status' => 'required|numeric',
            'where_page' => 'required|numeric',
            'location' => 'required|numeric',
            'platform_status' => 'nullable|numeric',
            'type_open' => 'nullable|numeric',
            'ads_type' => 'nullable|numeric',
            'banner_type' => 'nullable|numeric',
            'button_title' => 'nullable|min:2|max:255',
            'date_start' => 'required|date',
            'date_end' => 'nullable|date|after:Start',
        ]);

        $advertise=Advertise::create(array_merge($request->except('pic'),['user_id' => Auth::user()->id]));
        if($request->hasFile('pic'))
        {
            $destination= base_path().'/public/upload/advertise/'.date('Y').'/'.date('m');
            if(!is_dir($destination))
            {
                mkdir($destination,0777,true);
            }
            $destination=$destination.'/';
            $filename=rand(1111111,99999999);
            $file=$request->file('pic');
            $file->move($destination,$filename.'.'.$request->pic->getClientOriginalExtension());
            $advertise->update(['pic' => '/upload/advertise/'.date('Y').'/'.date('m').'/'.$filename.'.'.$request->pic->getClientOriginalExtension()]);
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
        $query=Advertise::findOrFail($id);
        $title=' ویرایش '.$query->title;
        return view('admin.advertise.edit',compact('title','query'));
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
        $advertise=Advertise::findOrFail($id);
        $this->validate($request,[
            'title_en' => 'required|min:2|max:255',
            'title' => 'required|min:2|max:255',
            'pic' => 'nullable|mimes:jpg,jpeg,png,gif|max:10240',
            'pic_alt' => 'required|min:2|max:255',
            'url' => 'required|url',
            'description' => 'nullable|min:2|max:255',
            'status' => 'required|numeric',
            'where_page' => 'required|numeric',
            'location' => 'required|numeric',
            'platform_status' => 'nullable|numeric',
            'type_open' => 'nullable|numeric',
            'ads_type' => 'nullable|numeric',
            'banner_type' => 'nullable|numeric',
            'button_title' => 'nullable|min:2|max:255',
            'date_start' => 'required|date',
            'date_end' => 'nullable|date|after:Start',
        ]);

        //$advertise=Advertise::create(array_merge($request->except('pic'),['user_id' => Auth::user()->id]));
        $advertise->update($request->except('pic'));
        if($request->hasFile('pic'))
        {
            $destinationbefore = base_path() . '/public/'.$advertise->pic;
            //return $destinationbefore;
            if(file_exists($destinationbefore) && $advertise->file != '')
            {
                unlink($destinationbefore);
            }
            $destination= base_path().'/public/upload/advertise/'.date('Y').'/'.date('m');
            if(!is_dir($destination))
            {
                mkdir($destination,0777,true);
            }
            $destination=$destination.'/';
            $filename=rand(1111111,99999999);
            $file=$request->file('pic');
            $file->move($destination,$filename.'.'.$request->pic->getClientOriginalExtension());
            $advertise->update(['pic' => '/upload/advertise/'.date('Y').'/'.date('m').'/'.$filename.'.'.$request->pic->getClientOriginalExtension()]);
        }

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
        $find=Advertise::findOrFail($id);
        $find->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
