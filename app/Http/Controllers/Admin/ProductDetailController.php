<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductDetail;
use App\ProductDetailStructed;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query1=ProductDetail::where('product_id',$request->id)->select('id')->get()->pluck('id');
        $query=ProductDetailStructed::whereIn('product_detail_id',$query1)->with('father')->get();
        //return $query;
        $find=Product::findOrFail($request->id);
        $title=' مشخصات ثبت شده برای محصول '.$find->title;
        return view('admin.product.detail.index',compact('title','query','find'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $query=Product::findOrFail($request->id);
        $title='ثبت مشخصات برای محصول'.$query->title;
        $titles=ProductDetailStructed::select('title')->groupBy('title')->get()->pluck('title')->toArray();
        //return $titles;
        return view('admin.product.detail.create',compact('title','query','titles'));
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
            'product_id' => 'required|numeric',
            'type' => 'required|numeric',
            'text' => 'required|string|min:2',
            'status' => 'required|numeric',
        ]);

        $check=ProductDetail::where('type',$request->type)->where('product_id',$request->product_id)->count();
        if($check==0)
        {
            $detail=ProductDetail::create([
                'product_id' => $request->product_id,
                'type' => $request->type,
                'title' => Helper::type_to_title_product_detail($request->type),
            ]);
        }
        else{
            $detail=ProductDetail::where('type',$request->type)->where('product_id',$request->product_id)->firstOrFail();
        }

        ProductDetailStructed::create([
            'product_detail_id' => $detail->id,
            'title' => $request->title2 != '' ? $request->title2 : $request->title,
            'text' => $request->text,
            'type' => 1,
            'status' => $request->status,
        ]);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find=ProductDetailStructed::findOrFail($id);
        $find->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
