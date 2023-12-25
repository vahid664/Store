<?php

namespace App\Http\Controllers\Admin;

use App\Factor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FactorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='فاکتورهای صادر شده';
        $query=Factor::with(['product','peyk'])->orderByDesc('id')->paginate(3000);
        //return $query;
        return view('admin.factor.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $query=Factor::findOrFail($request->id);
        $query->update(['status' => 1, 'status_check' => 1]);
        return redirect()->back();
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
        $query=Factor::findOrFail($id);
        $query->update(['delivery' => 1]);
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query=Factor::with(['off','peyk','gift'])->findOrFail($id);
        //return $query->gift->gift->product;
       // return explode('-',$query->description);
        $title='چاپ فاکتور مشتری '.$query->user->mobile;
        return view('admin.factor.factor_new',compact('title','query'));
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
        $find=Factor::findOrFail($id);
        $this->validate($request,[
            'post_tracking' => 'required|min:1|max:40'
        ]);
        $find->update(['post_tracking' => $request->post_tracking]);
        return redirect()->back()->with('status','ثبت موفق کد رهگیری پستی');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find=Factor::findOrFail($id)->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
