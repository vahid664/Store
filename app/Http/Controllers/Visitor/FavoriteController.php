<?php

namespace App\Http\Controllers\Visitor;

use App\Favorite;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=Favorite::where('user_id',Auth::user()->id)->orderByDesc('id')->paginate(8);
        $title='لیست علاقه مندی ها';
        return view('user.favorite.index',compact('title','query'));
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
        $product=Product::findOrFail($id);
        $check=Favorite::where('user_id',Auth::user()->id)
            ->where('product_id',$id)
            ->count();

        if($check==0)
        {
            Favorite::create([
                'user_id' => Auth::user()->id,
                'product_id' => $id
            ]);
            return response()->json('افزودن به علاقه مندی ها');
        }
        else
        {
            Favorite::where('user_id',Auth::user()->id)
                ->where('product_id',$id)->delete();
            return response()->json('حذف از علاقه مندی ها');
        }
        //return response()->json('افزودن به علاقه مندی');
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
        $find=Favorite::findOrFail($id)->delete();
        return redirect()->back();
    }
}
