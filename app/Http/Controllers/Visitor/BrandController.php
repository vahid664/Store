<?php

namespace App\Http\Controllers\Visitor;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BrandController extends Controller
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
        //return $id;
        $id=str_replace('-',' ',$id);
        //return $id;
        $brand=Brand::where('title_en',$id)->first();
        if(!isset($brand->id))
        {
            return redirect('/');
        }
        $product=Product::where('brand_id',$brand->id)
            ->active()
            ->select(['id','title','title_en','short_text','price_type','status','price','price_percent','entity'])
            ->with(['picfirst','color','awesome'])
            ->orderBy('price_type')
            ->orderByDesc('status')
            ->orderByDesc('id')
            ->paginate(32);
        $now=Carbon::now()->format('Y/m/d');
        $list_without_awesome=[];
        $product->getCollection()->transform(function ($product) use($now){
            if($product->awesome != '')
            {
                if ($product->awesome->date_end != '')
                {

                    if($product->awesome->date_end < $now)
                    {

                        unset($product->awesome);
                        $product->awesome=null;
                        return $product;
                        //dd($query->awesome=null);
                    }
                    else{
                        // return $product;
                        if($product->awesome->entity <= 0 )
                        {
                            unset($product->awesome);
                            $product->awesome=null;
                            return $product;
                        }
                        else
                        {
                            return $product;
                        }
                    }
                }
                else
                {
                    if($product->awesome->entity <= 0 )
                    {
                        unset($product->awesome);
                        $product->awesome=null;
                        return $product;
                    }
                    else
                    {
                        return $product;
                    }
                }

            }
            else
            {
                return $product;
            }
        });
        $title=$brand->title;
        if ($brand->title_page != '')
        {
            $title=$brand->title_page;
        }
        $keywords=$brand->keywords;
        $description=$brand->description;
        return view('visitor.brand.index',compact('title','keywords','description','brand','product'));
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
