<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\ArticlePic;
use App\Http\Controllers\Controller;
use App\TagArticleRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="مقالات سایت";
        $query=Article::with(['user','category','pics'])->orderByDesc('id')->get();
        return view('admin.article.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title="ثبت مقاله";
        return view('admin.article.create',compact('title'));
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
            'title_en' => 'required|min:2|max:255|unique:articles',
            'title' => 'required|min:2|max:255|unique:articles',
            'index' => 'required|numeric',
            'category_id' => 'required|numeric',
            'status' => 'required|numeric',
            'keywords' => 'nullable|min:3|max:75',
            'description' => 'nullable|min:3|max:255',
            'long_text' => 'required|min:3',
            'period' => 'required|numeric',
        ]);

        $article=Article::create(array_merge($request->except(['files','tags']),['user_id' => Auth::user()->id]));
        if(isset($request->tags))
        {
            foreach ($request->tags as $value)
            {
                TagArticleRelation::create([
                    'tag_id' => $value,
                    'article_id' => $article->id,
                ]);
            }
        }
        if($request->hasFile('files'))
        {
            $rules = array('file' => 'mimes:jpg,jpeg,png,gif');
            $i=0;
            $destination= base_path().'/public/upload/article/'.date('Y').'/'.date('m');
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
                    ArticlePic::create([
                        'article_id' => $article->id,
                        'title' => $request->title_file[$i],
                        'link' => '/upload/article/'.date('Y').'/'.date('m').'/'.$filename.'.'.$item->getClientOriginalExtension(),
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
        $query=Article::findOrFail($id);
        $title='ویرایش '.$query->title;
        return view('admin.article.edit',compact('title','query'));
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
        $article=Article::findOrFail($id);
        $this->validate($request,[
            'title_en' => 'required|min:2|max:255',
            'title' => 'required|min:2|max:255',
            'index' => 'required|numeric',
            'category_id' => 'required|numeric',
            'status' => 'required|numeric',
            'keywords' => 'nullable|min:3|max:75',
            'description' => 'nullable|min:3|max:255',
            'long_text' => 'required|min:3',
            'period' => 'required|numeric',
        ]);

        $article->update($request->except(['files','tags','title_file']));
        if(isset($request->tags))
        {
            TagArticleRelation::where('article_id',$id)->delete();
            foreach ($request->tags as $value)
            {
                TagArticleRelation::create([
                    'tag_id' => $value,
                    'article_id' => $article->id,
                ]);
            }
        }
        if($request->hasFile('files'))
        {
            $rules = array('file' => 'mimes:jpg,jpeg,png,gif');
            $i=0;
            $destination= base_path().'/public/upload/article/'.date('Y').'/'.date('m');
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
                    ArticlePic::create([
                        'article_id' => $article->id,
                        'title' => $request->title_file[$i],
                        'link' => '/upload/article/'.date('Y').'/'.date('m').'/'.$filename.'.'.$item->getClientOriginalExtension(),
                        'type' => 1
                    ]);
                }
                $i++;
            }
        }
        return redirect()->back()->with('status','ثبت موفق اطلاعات');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find=Article::findOrFail($id);
        $find->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
