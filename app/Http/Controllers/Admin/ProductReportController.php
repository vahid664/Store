<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategoryRelation;
use Illuminate\Http\Request;

class ProductReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $title='گزارش گیری پیشرفته محصولات';
        $query=Product::query();
        if(isset($request->title))
        {
            $query->where('title','like',$request->title.'%');
        }
        if (isset($request->category_id))
        {
            $cat_pro_id=ProductCategoryRelation::whereIn('category_id',$request->category_id)
                ->select('product_id')
                ->get()->pluck('product_id')->toArray();
            $query->whereIn('id',array_unique($cat_pro_id));
        }
        if(isset($request->price_type))
        {
            $query->where('price_type',$request->price_type);
        }
        if(isset($request->price_first))
        {
            $query->where('price','>=',$request->price_first);
        }
        if(isset($request->price_end))
        {
            $query->where('price','<=',$request->price_end);
        }
        if (isset($request->percent_first))
        {
            $query->where('price_percent','>=',$request->percent_first);
        }
        if(isset($request->percent_end))
        {
            $query->where('price_percent','<=',$request->percent_end);
        }
        if(isset($request->entity))
        {
            $query->where('entity',$request->entity);
        }
        if (isset($request->brand_id))
        {
            $query->where('brand_id',$request->brand_id);
        }
        if (isset($request->status))
        {
            $query->where('status',$request->status);
        }
        if(isset($request->date))
        {
            if (isset($request->date_start))
            {
                $query->where($request->date,'>=',$request->date_start);
            }
            if (isset($request->date_end))
            {
                $query->where($request->date,'<=',$request->date_end);
            }
        }
        $check=Helper::CheckIsset($request->all());
        //return $check;
        if ($check==0 || $check==null)
        {
            $query->orderByDesc('id')->take(100);
            $data=[
                'title' => null,
                'price_type' => null,
                'price_first' => null,
                'price_end' => null,
                'percent_first' => null,
                'percent_end' => null,
                'entity' => null,
                'brand_id' => null,
                'status' => null,
                'date' => null,
                'date_start' => null,
                'date_end' => null,
            ];
        }
        else
        {
            $query->orderByDesc('id');
            $data=$request->all();
        }
        $query=$query->get();

        //return $data;
        return view('admin.product_report.index',compact('title','query','data'));
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
