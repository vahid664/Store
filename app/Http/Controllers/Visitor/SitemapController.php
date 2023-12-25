<?php

namespace App\Http\Controllers\Visitor;

use App\Article;
use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Page;
use App\Product;
use App\Tag;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function sitemap()
    {
        return response()->view('visitor.sitemap.sitemap')->header('Content-Type','text/xml');
    }

    public function statics()
    {
        $query=Page::where('status',1)->orderByDesc('id')->get();
        return response()->view('visitor.sitemap.statics',compact('query'))->header('Content-Type','text/xml');
    }

    public function brand()
    {
        $query=Brand::where('status',1)->orderByDesc('id')->paginate(1000);
        return response()->view('visitor.sitemap.brand',compact('query'))->header('Content-Type','text/xml');
    }

    private function getChildren($category){
        $ids = [];
        foreach ($category->childern as $cat) {
            $ids[] = $cat->id;
            $ids = array_merge($ids, $this->getChildren($cat));
        }
        return $ids;
    }

    public function blog()
    {
        /*$find=Category::findOrFail(19);
        $array_of_ids = $this->getChildren($find);
        array_push($array_of_ids, 19);*/
        $query=Article::active()->paginate(1000);
		//return $query;
        return response()->view('visitor.sitemap.blog',compact('query'))->header('Content-Type','text/xml');
    }

    public function category()
    {
        $query=Category::active()->where('parent','<>',0)->paginate(1000);
        return response()->view('visitor.sitemap.category',compact('query'))->header('Content-Type','text/xml');
    }

    public function tag()
    {
        $query=Tag::active()->paginate(1000);
        return response()->view('visitor.sitemap.tag',compact('query'))->header('Content-Type','text/xml');
    }

    public function post()
    {
        $query=Product::active()->with('picfirst')->orderBy('id','desc')->paginate(1000);
        return response()->view('visitor.sitemap.post',compact('query'))->header('Content-Type','text/xml');
    }
}
