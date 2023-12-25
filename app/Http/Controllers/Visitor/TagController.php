<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Product;
use App\Tag;
use App\TagProductRelation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagController extends Controller
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
        $id=str_replace('-',' ',$id);
        //return $id;
        $tag=Tag::where('title_en',$id)->firstOrFail();
        $tag_product_rel=TagProductRelation::where('tag_id',$tag->id)
            ->select('product_id')->get()->pluck('product_id')->toArray();
        //return $tag_product_rel;
        $product=Product::whereIn('id',$tag_product_rel)
            ->active()
            ->select(['id','title','title_en','short_text','status','price_type','price','price_percent','entity'])
            ->with(['picfirst','color','awesome'])
            ->orderBy('price_type')
            ->orderBy('status')
            ->orderByDesc('id')
            ->paginate(36);
        $date_now=Carbon::now()->format('Y/m/d');
        /*$list_without_awesome=[];
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
        });*/
        $title=$tag->title;
        $keywords=$tag->title;
        $description=$tag->title;
        return view('visitor.tag.index',compact('title','date_now','tag','product','keywords','description'));
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
