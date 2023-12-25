<?php

namespace App\Http\Controllers\Visitor;

use App\Article;
use App\Http\Controllers\Controller;
use App\TagArticleRelation;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keywords='وبلاگ استاویتا استور';
        $description='وبلاگ استاویتا استور';
        $title='وبلاگ استاویتا استور';
        $query=Article::active()->with(['category','picfirst'])->orderByDesc('id')->paginate(8);
        //return $query;
        return view('visitor.blog.index',compact('title','query','keywords','description'));
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
        $query=Article::findOrFail($id);
        $query->increment('visit');
        $title=$query->title;
        //return  $query->tag_rel->pluck('tag_id')->toArray();
        $similar=TagArticleRelation::whereIn('tag_id', $query->tag_rel->pluck('tag_id')->toArray())
            ->with('article')->where('article_id','<>',$query->id)
            ->orderByDesc('id')->take(10)->get();
      /*  return $similar;
        foreach ($similar as $item)
        {
            var_dump($item->tag->article).'<br>';
        }
        die();*/
        //return  $similar;
        return view('visitor.blog.show',compact('title','query','similar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
