<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\ProductOffer;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class ProductOfferController extends Controller
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
        $this->validate($request,[
            'price_observed' => 'required|numeric',
            'url_address' => 'nullable|min:3|max:255'
        ]);
        $agent=new Agent();
        ProductOffer::create([
            'product_id' => $request->product_id,
            'price_observed' => $request->price_observed,
            'url_address' => $request->url_address,
            'ip' => $request->ip(),
            'os' =>  $agent->platform().$agent->version($agent->platform()),
        ]);
        return redirect()->back()->with('ProductOffer' ,'قیمت پیشنهادی ثبت گردید' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductOffer  $productOffer
     * @return \Illuminate\Http\Response
     */
    public function show(ProductOffer $productOffer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductOffer  $productOffer
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductOffer $productOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductOffer  $productOffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductOffer $productOffer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductOffer  $productOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductOffer $productOffer)
    {
        //
    }
}
