<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Color;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategoryRelation;
use App\ProductColor;
use App\ProductPic;
use App\ProductSize;
use App\Tag;
use App\TagProductRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title='محصولات';
        $query=Product::orderByDesc('id');
        if(isset($request->cat))
        {
            $cat=Category::findOrFail($request->cat);
            $title='محصولات '.$cat->title;
            $product_cat_rel=ProductCategoryRelation::where('category_id',$request->cat)
                ->select('product_id')->get()->pluck('product_id')->toArray();
            $query->whereIn('id',$product_cat_rel);
        }
        $query=$query->get();
        return view('admin.product.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='افزودن محصول';
        $tag=Tag::active()->orderByDesc('id')->get();
        return view('admin.product.create',compact('title','tag'));
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
            'title_en' => 'required|min:2|max:255|unique:products',
            'title' => 'required|min:2|max:255|unique:products',
            'title_page' => 'required|min:2|max:255|unique:products',
            'price_type' => 'required|numeric',
            'price' => 'required|numeric',
            'price_percent' => 'required|numeric',
            'price_self_buy' => 'required|numeric',
            'entity' => 'required|numeric',
            'category_id' => 'required|array',
            'brand_id' => 'required|numeric',
            'origin' => 'required|numeric',
            'deliver' => 'required|numeric',
            'warranty' => 'required|numeric',
            'status' => 'required|numeric',
            'position' => 'required|numeric',
            'keywords' => 'nullable|min:3|max:75',
            'description' => 'nullable|min:3|max:255',
            'long_text' => 'required|min:3',
        ]);

        $product=Product::create(array_merge($request->except(['color','size','category_id','title_file','files'])
            ,['user_id' => Auth::user()->id]));
        if(isset($request->tags))
        {
            foreach ($request->tags as $value)
            {
                TagProductRelation::create([
                    'tag_id' => $value,
                    'product_id' => $product->id,
                ]);
            }
        }
        if(isset($request->color))
        {
            $color=Color::whereIn('id',$request->color)->get();
            foreach ($color as $value)
            {
                ProductColor::create([
                    'product_id' => $product->id,
                    'title' => $value->title,
                    'title_factory' => $value->title_factory,
                    'color' => $value->color,
                ]);
            }
        }
        if(isset($request->size))
        {
            foreach ($request->size as $item)
            {
                ProductSize::create([
                    'product_id' => $product->id,
                    'title' => $item,
                ]);
            }
        }
        if(isset($request->category_id))
        {
            foreach ($request->category_id as $cat)
            {
                ProductCategoryRelation::create([
                    'product_id' => $product->id,
                    'category_id' => $cat,
                ]);
            }
        }

        if($request->hasFile('files'))
        {
            $rules = array('file' => 'mimes:jpg,jpeg,png,gif');
            $i=0;
            $destination= base_path().'/public/upload/product/'.date('Y').'/'.date('m');
            if(!is_dir($destination))
            {
                mkdir($destination,0777,true);
            }
            foreach ($request->file('files') as $item)
            {
                $validator = Validator::make(array('file'=> $item), $rules);
                if($validator->passes()) {

                    $destination=$destination.'/';
                    $filename=rand(1111111,99999999);
                    $file=$item;
                    $file->move($destination,$filename.'.'.$item->getClientOriginalExtension());
                    ProductPic::create([
                        'user_id' => Auth::user()->id,
                        'product_id' => $product->id,
                        'title' => $request->title_file[$i],
                        'link' => '/upload/product/'.date('Y').'/'.date('m').'/'.$filename.'.'.$item->getClientOriginalExtension(),
                        'type' => 1
                    ]);
                }
                $i++;
            }
        }

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
        $query=Product::with('tag_rel')->findOrFail($id);
        //return $query->tag_rel->pluck('tag')->pluck('id');
        $tag=Tag::orderByDesc('id')->get();
        //return $tag;
        $title='ویرایش '.$query->title;
        //return $query->category_rel->pluck('category_id')->toArray();
        return view('admin.product.edit',compact('title','query','tag'));
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
        $product=Product::findOrFail($id);
        $this->validate($request,[
            'title_en' => 'required|min:2|max:255',
            'title' => 'required|min:2|max:255',
            'title_page' => 'required|min:2|max:255',
            'price_type' => 'required|numeric',
            'price' => 'required|numeric',
            'price_percent' => 'required|numeric',
            'price_self_buy' => 'required|numeric',
            'entity' => 'required|numeric',
            'category_id' => 'required|array',
            'brand_id' => 'required|numeric',
            'origin' => 'required|numeric',
            'deliver' => 'required|numeric',
            'warranty' => 'required|numeric',
            'status' => 'required|numeric',
            'keywords' => 'nullable|min:3|max:75',
            'description' => 'nullable|min:3|max:255',
            'long_text' => 'required|min:3',
        ]);

        $product->update($request->except(['color','size','category_id','title_file','files']));
        if(isset($request->tags))
        {
            TagProductRelation::where('product_id',$id)->delete();
            foreach ($request->tags as $value)
            {
                TagProductRelation::create([
                    'tag_id' => $value,
                    'product_id' => $product->id,
                ]);
            }
        }
        else{
            TagProductRelation::where('product_id',$id)->delete();
        }
        if(isset($request->color))
        {
            $color=Color::whereIn('id',$request->color)->get();
            ProductColor::where('product_id',$product->id)->whereNotIn('title',$color->pluck('title'))->delete();
            foreach ($color as $value)
            {
                $check=ProductColor::where('product_id',$product->id)
                    ->where('color',$value->color)->count();
                if($check == 0)
                {
                    ProductColor::create([
                        'product_id' => $product->id,
                        'title' => $value->title,
                        'color' => $value->color,
                        'title_factory' => $value->title_factory,
                    ]);
                }
            }
        }
        else{
            ProductColor::where('product_id',$product->id)->delete();
        }

        if(isset($request->size))
        {
            /*ProductSize::where('product_id',$product->id)->delete();
            foreach ($request->size as $item)
            {
                ProductSize::create([
                    'product_id' => $product->id,
                    'title' => $item,
                ]);
            }*/
            //return $request->size;
            $size=ProductSize::where('product_id',$product->id)->get();
            //return $size;
            ProductSize::where('product_id',$product->id)->whereNotIn('title',$request->size)->delete();
            foreach ($request->size as $value)
            {
                $check=ProductSize::where('product_id',$product->id)
                    ->where('title',$value)->count();
                if($check == 0)
                {
                    ProductSize::create([
                        'product_id' => $product->id,
                        'title' => $value,
                    ]);
                }
            }
        }
        else{
            ProductSize::where('product_id',$product->id)->delete();
        }
        if(isset($request->category_id))
        {
            ProductCategoryRelation::where('product_id',$product->id)->delete();
            foreach ($request->category_id as $cat)
            {
                ProductCategoryRelation::create([
                    'product_id' => $product->id,
                    'category_id' => $cat,
                ]);
            }
        }

        if($request->hasFile('files'))
        {
            $rules = array('file' => 'mimes:jpg,jpeg,png,gif');
            $i=0;
            $destination= base_path().'/public/upload/product/'.date('Y').'/'.date('m');
            if(!is_dir($destination))
            {
                mkdir($destination,0777,true);
            }
            foreach ($request->file('files') as $item)
            {
                $validator = Validator::make(array('file'=> $item), $rules);
                if($validator->passes()) {

                    $destination=$destination.'/';
                    $filename=rand(1111111,99999999);
                    $file=$item;
                    $file->move($destination,$filename.'.'.$item->getClientOriginalExtension());
                    ProductPic::create([
                        'user_id' => Auth::user()->id,
                        'product_id' => $product->id,
                        'title' => $request->title_file[$i],
                        'link' => '/upload/product/'.date('Y').'/'.date('m').'/'.$filename.'.'.$item->getClientOriginalExtension(),
                        'type' => 1
                    ]);
                }
                $i++;
            }
        }

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
        $find=Product::findOrFail($id);
        $find->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
