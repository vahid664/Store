<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBrandManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='مدیریت محصولات براساس برند';
        return view('admin.management_brand.index',compact('title'));
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
        //return $request->all();
        if ($request->section == 1)
        {
            Product::where('brand_id',$request->brand_id)->update(['status' => $request->status]);
        }
        elseif ($request->section == 2){
            if (!isset($request->darsad))
            {
                return redirect()->back()->withErrors('درصدی برای افزایش قیمت مشخص نشده است!!!');
            }
            $darsad=$request->darsad / 100;
            DB::statement('UPDATE `products` SET `price`= (`price` + FLOOR('.$darsad.' * `price`)) + ( IF(SUBSTRING(`price` + FLOOR('.$darsad.' * `price`),-3) > 0 , 1000 - SUBSTRING(`price` + FLOOR('.$darsad.' * `price`),-3), 0) ) WHERE `brand_id`='.$request->brand_id);
        }
        else{

            if (!isset($request->darsad))
            {
                return redirect()->back()->withErrors('درصدی برای کاهش قیمت مشخص نشده است!!!');
            }
            $darsad=$request->darsad / 100;
            DB::statement('UPDATE `products` SET `price`= (`price` - FLOOR('.$darsad.' * `price`)) + ( IF(SUBSTRING(`price` - FLOOR('.$darsad.' * `price`),-3) > 0 , 1000 - SUBSTRING(`price` - FLOOR('.$darsad.' * `price`),-3), 0) ) WHERE `brand_id`='.$request->brand_id);
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
