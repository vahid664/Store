<?php

namespace App\Http\Controllers\Visitor;

use App\Brand;
use App\Category;
use App\Color;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategoryRelation;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class CategoryController extends Controller
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
    public function show($id, Request $request)
    {
        //return $request->all();
        $id=str_replace('-',' ',$id);
        $category=Category::where('title_en',$id)->firstOrFail();
        $list_category=$category->childern;
        if(count($list_category) == 0)
        {
            $parent=Category::where('id',$category->parent)->first();
            if(isset($parent->id))
            {
                $list_category=$parent->childern;
            }
        }
        $array_of_ids = $this->getChildren($category);
        array_push($array_of_ids, $category->id);
        $product_cat_rel=ProductCategoryRelation::whereIn('category_id',$array_of_ids)
            ->select('product_id')->get()->pluck('product_id')->toArray();
        $query=Product::whereIn('products.id',$product_cat_rel)
            ->active()
            ->select('products.*');
        $query->addSelect(DB::raw('products.price - (products.price_percent * (products.price/100)) as discount'));

        $brand=$query;
        $brand=$brand->get()->pluck('brand_id')->unique();
        $brand_list=Brand::whereIn('id',$brand)->get();
        $query=$query->with(['picfirst','color','awesome']);
        if (isset($request->entity) && $request->entity==1)
        {
            $query->where('products.entity','>',0)->where('products.status',1);
        }

        if (isset($request->brand))
        {
            if (strpos($request->brand, ',') !== false)
            {
                $list_brand=explode(',',$request->brand);
                $query->whereIn('products.brand_id',$list_brand);
            }
            else{
                $query->where('products.brand_id',$request->brand);
            }
        }
        if (isset($request->size) && $request->size != '')
        {
            $list_size=Helper::UrlParameterToArray($request->size);
            $query->with(['size' =>  function ($query) use ($list_size) {
                $query->whereIn('title',$list_size);
            }]);
        }
        if (isset($request->color) && $request->color != '')
        {
            $list_color=Helper::UrlParameterToArray($request->color);
            $query->with(['color' =>  function ($query) use ($list_color) {
                $query->whereIn('title',$list_color);
            }]);
        }
        if (isset($request->discount)){
            $query->where('price_type',2);
        }
        if (isset($request->sort))
        {
            switch ($request->sort)
            {
                case 1:
                    $query->orderByDesc('visit');
                break;
                case 2:
                    $query->orderByDesc('id');
                break;
                case 3:
                    $query->orderBy('discount');
                break;
                case 4:
                    $query->orderByDesc('discount');
                break;
            }
        }
        else{
            $query->orderBy('price_type')
                ->orderBy('status')
                ->orderByDesc('id');
        }
        //$query->filter(function ($value) { return count($value->color); });
        $product=$query->paginate(48);
        //return $product;
        //return $product->where('size',$request->size);
        $date_now=Carbon::now()->format('Y/m/d');
        $title=$category->title;
        if ($category->title_page != '')
        {
            $title=$category->title_page;
        }
        $keywords=$category->keywords;
        $description=$category->description;

        $sizes=Size::where('parent','<>',0)->select('title')->distinct('title')->get();
        $colors=Color::where('parent','<>',0)->select('title')->distinct('title')->get();
        $agent=new Agent();
        return view('visitor.category.index',compact('title','date_now','agent','keywords','colors','sizes','description','list_category','category','product','brand_list'));
    }

    private function getChildren($category){
        $ids = [];
        foreach ($category->childern as $cat) {
            $ids[] = $cat->id;
            $ids = array_merge($ids, $this->getChildren($cat));
        }
        return $ids;
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
