<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use App\ProductCategoryRelation;
use Illuminate\Http\Request;

class CopyProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query=Brand::findOrFail($request->id);
        $title='کپی محصولات برند '.$query->title;
        return view('admin.copy_product.index',compact('title','query'));
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
        $brand=Brand::findOrFail($request->id);
        $data= $brand->product->pluck('id')->toArray();
        if(count($data))
        {
            foreach ($data as $value)
            {
                $count=ProductCategoryRelation::where('product_id',$value)
                    ->where('category_id',$request->category_id)
                    ->count();
                if($count == 0)
                {
                    ProductCategoryRelation::create([
                        'product_id' => $value,
                        'category_id' => $request->category_id,
                    ]);
                }
            }
        }
        return redirect('Admin/Brand')->with('status','کپی محصولات برند به دسته بندی موفق');
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
