<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategoryRelation;
use App\TagProductRelation;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $query=Product::active()->with(['category_first','pics','faqs','picfirst','brands','color','tag_rel','awesome','detail_first','detail'])->find($id);
        if(!isset($query->id))
        {
            return redirect('/');
        }
        //return $query;
        $query->increment('visit');
        $title=$query->title_page != '' ? $query->title_page : $query->title;
        $query_similar=[];
        //return $query->category_first->category_id;
        if($query->category_first->count())
        {
            //$product_id_similar=TagProductRelation::whereIn('tag_id',$query->tag_rel->pluck('tag_id'))->get()->pluck('product_id')->unique()->toArray();
            $product_id_similar=ProductCategoryRelation::where('category_id',$query->category_first->category_id)
                ->where('product_id','<>',$query->id)
                ->orderbyDesc('id')
                ->take(10)
                ->get()
                ->pluck('product_id')
                ->unique()
                ->toArray();
            //return $product_id_similar;
            //$product_id_similar=array_diff($product_id_similar,[$query->id]);
            //return $product_id_similar;
            //return $product_id_similar;
            $query_similar=Product::active()->whereIn('id',$product_id_similar)->with(['picfirst'])->orderByDesc('id')->get();
        }
        //return $query->category_first->category;
        return view('visitor.product.index',compact('title','query','query_similar'));
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
