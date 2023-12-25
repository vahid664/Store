<?php

namespace App\Http\Controllers\User;

use App\Favorite;
use App\Http\Controllers\Controller;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='پروفایل';
        $query_favorite=Favorite::where('user_id',Auth::user()->id)->orderBy('created_at')->take(3)->get();
        return view('user.profile.index',compact('title','query_favorite'));
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
        //
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
        //return Auth::user()->detail;
        $title='ویرایش اطلاعات شخصی';
        return view('user.profile.edit',compact('title'));
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
            'name' => 'required|min:2|max:30',
            'family' => 'required|min:2|max:30',
            'sex' => 'required|numeric|between:1,2',
            'national_code' => 'nullable|numeric|digits:10',
            'bill_cart' => 'nullable|numeric|digits:16',
        ]);

        Auth::user()->update(['name' => $request->name , 'family'=> $request->family]);
        UserDetail::updateOrCreate(
            ['user_id' => Auth::user()->id],
            [
                'national_code' => $request->national_code ,
                'sex' => $request->sex,
                'bill_cart' => $request->bill_cart,
            ]);
        return redirect()->back()->with('status','به روز رسانی موفق پروفایل');
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
