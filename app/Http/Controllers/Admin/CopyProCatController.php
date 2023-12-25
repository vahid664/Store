<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\ProductCategoryRelation;
use Illuminate\Http\Request;

class CopyProCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query=Category::findOrFail($request->id);
        $title='کپی محصولات دسته '.$query->title;
        return view('admin.copy_product.cat_copy',compact('title','query'));
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
        $cat=Category::findOrFail($request->id)->product_rell->pluck('product_id')->toArray();
        //return $cat;
        $cat2=Category::findOrFail($request->category_id)->product_rell->pluck('product_id')->toArray();
        //return $cat2;
        $cat_last=array_unique(array_diff($cat,$cat2));
        //return $cat_last;
        if (count($cat_last))
        {
            foreach ($cat_last as $value)
            {
                ProductCategoryRelation::create([
                    'product_id' => $value,
                    'category_id' => $request->category_id,
                ]);
            }
        }
        return redirect('Admin/Category')->with('status','کپی محصولات برند به دسته بندی موفق');
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
