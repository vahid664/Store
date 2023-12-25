<?php

namespace App\Http\Controllers\Visitor;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
        if (isset($request->title))
        {
            $this->validate($request,[
                'product_id' => 'required|numeric',
                'parent_id' => 'required|numeric',
                'title' => 'required|string|min:2|max:191',
                'text' => 'required|min:4|max:4000|string'
            ]);
        }
        else{
            $this->validate($request,[
                'product_id' => 'required|numeric',
                'parent_id' => 'required|numeric',
                'text' => 'required|min:4|max:4000|string'
            ]);
        }
        $product=Product::findOrFail($request->product_id);
        $comment=new Comment(array_merge($request->all(),
            [
                'user_id'=>Auth::user()->id,
                'parent' => $request->parent_id,
                'status' => Auth::user()->level == 121 ? 1 : 0
            ]));
        $product->comments()->save($comment);
        return redirect()->back()->with('status','نظر شما با موفقیت ثبت شد.');
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
