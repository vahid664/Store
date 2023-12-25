<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\ProductCategoryRelation;
use App\ProductSize;
use Illuminate\Http\Request;

class ProductCategoryManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='مدیریت محصولات براساس دسته بندی';
        return view('admin.management_category.index',compact('title'));
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
        if ($request->section == 1)
        {
            if (!isset($request->darsad))
            {
                return redirect()->back()->withErrors('درصدی برای افزایش قیمت مشخص نشده است!!!');
            }else{
                $productcategory =  ProductCategoryRelation::where('category_id' , 234 )->get();
                foreach ($productcategory as $item) {
                    $productsizes = ProductSize::where('product_id' , $item->product_id )->get();
                    foreach ($productsizes as $size){
                        $price = $size->price;
                        $darsad =$price*($request->darsad)/100;
                        $size->update(['price' => $price+$darsad]);
                    }
                }
            }
        }else{
            if (!isset($request->darsad))
            {
                return redirect()->back()->withErrors('درصدی برای کاهش قیمت مشخص نشده است!!!');
            }else{
                $productcategory =  ProductCategoryRelation::where('category_id' , $request->category_id )->get();
                foreach ($productcategory as $item) {
                    $productsizes = ProductSize::where('product_id' , $item->product_id )->get();
                    foreach ($productsizes as $size){
                        $price = $size->price;
                        $darsad =$price*($request->darsad)/100;
                        $size->update(['price' => $price-$darsad]);
                    }
                }
            }
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
        //
    }
}
