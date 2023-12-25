<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Product;
use App\SearchSave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $request->all();
        if(!isset($request->q))
        {
            return redirect('/');
        }
        if(strlen($request->q) <= 250)
        {
            SearchSave::create([
                'user_id' => Auth::check() ? Auth::user()->id : 0,
                'title' => $request->q
            ]);
        }
        /* $terms=explode(' ',$request->q);
        $product=Product::active()->where(function ($q) use ($terms){
            foreach ($terms as $term)
            {
                return $q->where('title','LIKE','%'.$term.'%');
            }
        })->orderBy('price_type')
            ->orderBy('status')
            ->orderByDesc('id')
			->paginate(36);*/
        /*$product=Product::active()->where('title','LIKE','%'.$request->q.'%')
            ->orWhere('title_en','LIKE','%'.$request->q.'%')
            ->orderBy('price_type')
            ->orderBy('status')
            ->orderByDesc('id')
            ->paginate(36);*/
		/*$terms=explode(' ',$request->q);
        $product=Product::active()->where(function ($q) use ($terms){
            foreach ($terms as $term)
            {
                return $q->where('title','LIKE','%'.$term.'%')
                    ->orWhere('title_en','LIKE','%'.$term.'%');
            }
        })->orderBy('price_type')
            ->orderBy('status')
            ->orderByDesc('id')
			->paginate(36);*/
        $terms= str_replace('ي', 'ی', $request->q);
        $terms = str_replace('ك', 'ک',$terms);
        $search=explode(' ',$terms);
        $product = Product::active()->where(array_map(function ($item){
            return ['title','like','%'.$item.'%'];
        },$search))->orWhere(array_map(function ($item){
            return ['title_en','like','%'.$item.'%'];
        },$search))
        ->orderBy('price_type')
        ->orderBy('status')
        ->orderByDesc('id')
        ->paginate(36);
        $title=$request->q;
        return view('visitor.search.index',compact('title','product'));
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
        return $id;
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
