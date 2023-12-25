<?php

namespace App\Http\Controllers\Visitor;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandAll;
use App\Http\Resources\Search;
use App\Product;
use Illuminate\Http\Request;

class SearchJsonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $terms= str_replace('ي', 'ی', $request->q);
        $terms = str_replace('ك', 'ک',$terms);
        $search=explode(' ',$terms);
        $query = Product::active()->where(array_map(function ($item){
            return ['title','like','%'.$item.'%'];
        },$search))->orWhere(array_map(function ($item){
            return ['title_en','like','%'.$item.'%'];
        },$search))
        ->orderBy('price_type')
        ->orderBy('status')
        ->orderByDesc('id')
        ->paginate(10);
        //$query=Product::active()->where('title','LIKE',$request->q.'%')->orWhere('title_en','LIKE',$request->q.'%')->paginate(10);
        $total=$query->total();
        /*if($total==0)
        {
            $terms=explode(' ',$request->q);
            $query=Product::active()->where(function ($q) use ($terms){
                foreach ($terms as $term)
                {
                    return $q->orWhere('title','LIKE',$term.'%')
                        ->orWhere('title_en','LIKE',$term.'%');
                }
            })->orderBy('price_type')
                ->orderBy('status')
                ->orderByDesc('id')
                ->paginate(10);
        }*/
        $data['product']=new Search($query->items());
        $brand=Brand::active()
            ->where('title','LIKE',$request->q.'%')
            ->orWhere('title_en','LIKE',$request->q.'%')
            ->paginate(2);
        $data['brand']=new BrandAll($brand);
        $category=Category::active()
            ->where('title',$request->q)
            ->orWhere('title_en',$request->q)
            ->paginate(2);
        $data['category']=new \App\Http\Resources\Category($category);
        $total+=$brand->total();
        $total+=$category->total();

        return response()->json(['total_count' => $total,
            'incomplete_results' => false, 'items' => $data]);
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
