<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $size=ProductSize::findOrFail($request->id);
        $size->update($request->all());
        $product=Product::findOrFail($size->product_id);
        $all_entity=ProductSize::where('product_id',$size->product_id)->sum('entity');
        $product->update(['entity' => $all_entity]);
        if($size->status == 1){
            $type=$size->price_discount == 0 ? 1 : 2;
            $product->update(['price' => $size->price, 'price_type' => $type, 'price_percent' => $size->price_discount]);
        }
        return redirect()->back()->with('status','به روز رسانی موفق');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $size=ProductSize::findOrFail($id);
        $product=Product::findOrFail($size->product_id);
        ProductSize::where('product_id',$size->product_id)->update(['status' => 0]);
        $size->update(['status' => 1]);
        $type=$size->price_discount == 0 ? 1 : 2;
        $product->update(['price' => $size->price, 'price_type' => $type, 'price_percent' => $size->price_discount]);
        return redirect()->back()->with('status','به روز رسانی موفق');
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
        //
    }
}
