<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAwesome;
use App\ProductCategoryRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductAwesomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='محصولات ویژه شده';
        $query=ProductAwesome::with(['product','user'])->orderBy('sort')->get();
        //return $query;
        return view('admin.product_awesome.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='ویژه کردن محصول';
        $product=Product::active()->orderByDesc('id')->get();
        return view('admin.product_awesome.create',compact('title','product'));
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
            'title' => 'required|min:2|max:255',
            'product_id' => 'required|numeric|unique:product_awesomes',
            'price' => 'required|numeric',
            'price_percent' => 'required|numeric',
            /*'entity' => 'required|numeric',*/
            'date_start' => 'required|date',
            'date_end' => 'required|date|after:date_start',
            'hour_start' => 'required|numeric',
            'hour_end' => 'required|numeric|gt:hour_start',
        ]);
        ProductAwesome::create(array_merge($request->all(),['user_id' => Auth::user()->id]));
        ProductCategoryRelation::create([
            'product_id' => $request->product_id,
            'category_id' => 233,
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
        $query=ProductAwesome::findOrFail($id);
        $title='ویرایش '.$query->title;
        $product=Product::active()->orderByDesc('id')->get();
        return view('admin.product_awesome.edit',compact('title','query','product'));
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
            'title' => 'required|min:2|max:255',
            'product_id' => 'required|numeric',
            'price' => 'required|numeric',
            'price_percent' => 'required|numeric',
            /*'entity' => 'required|numeric',*/
            'date_start' => 'required|date',
            'date_end' => 'required|date|after:date_start',
            'hour_start' => 'required|numeric',
            'hour_end' => 'required|numeric|gt:hour_start',
        ]);

        $find=ProductAwesome::findOrFail($id);
        $find->update($request->all());
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
        $find=ProductAwesome::findOrFail($id);
        $cat_rel=ProductCategoryRelation::where('category_id',233)
            ->where('product_id',$find->product_id)->delete();
        $find->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
