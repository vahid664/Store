<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='شبکه های اجتماعی';
        $query=Social::with('user')->orderByDesc('id')->get();
        return view('admin.social.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='ثبت شبکه اجتماعی';
        return view('admin.social.create',compact('title'));
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
            'pic' => 'nullable|mimes:jpg,jpeg,png,gif|max:10240',
            'description' => 'nullable|min:2|max:255',
            'status' => 'required|numeric',
            'type' => 'required|numeric',
        ]);

        $social=Social::create(array_merge($request->all(),['user_id' => Auth::user()->id]));
        if($request->hasFile('pic'))
        {
            $destination= base_path().'/public/upload/social/'.date('Y').'/'.date('m');
            if(!is_dir($destination))
            {
                mkdir($destination,0777,true);
            }
            $destination=$destination.'/';
            $filename=rand(1111111,99999999);
            $file=$request->file('pic');
            $file->move($destination,$filename.'.'.$request->pic->getClientOriginalExtension());
            $social->update(['pic' => '/upload/social/'.date('Y').'/'.date('m').'/'.$filename.'.'.$request->pic->getClientOriginalExtension()]);
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
        $query=Social::findOrFail($id);
        $title=' ویرایش '.$query->title;
        return view('admin.social.edit',compact('title','query'));
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
        $social=Social::findOrFail($id);
        $this->validate($request,[
            'title' => 'required|min:2|max:255|unique:brands',
            'pic' => 'nullable|mimes:jpg,jpeg,png,gif|max:10240',
            'description' => 'nullable|min:2|max:255',
            'status' => 'required|numeric',
            'type' => 'required|numeric',
        ]);

        $social->update($request->except('pic'));
        if($request->hasFile('pic'))
        {
            $destinationbefore = base_path() . '/public/'.$social->pic;
            //return $destinationbefore;
            if(file_exists($destinationbefore) && $social->file != '')
            {
                unlink($destinationbefore);
            }
            $destination= base_path().'/public/upload/social/'.date('Y').'/'.date('m');
            if(!is_dir($destination))
            {
                mkdir($destination,0777,true);
            }
            $destination=$destination.'/';
            $filename=rand(1111111,99999999);
            $file=$request->file('pic');
            $file->move($destination,$filename.'.'.$request->pic->getClientOriginalExtension());
            $social->update(['pic' => '/upload/social/'.date('Y').'/'.date('m').'/'.$filename.'.'.$request->pic->getClientOriginalExtension()]);
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
        $find=Social::findOrFail($id);
        $find->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
