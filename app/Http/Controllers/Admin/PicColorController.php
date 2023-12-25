<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PicColorRelation;
use Illuminate\Http\Request;

class PicColorController extends Controller
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
        $data=explode('|',$request->data);
        if ($data[1] == 0)
        {
            PicColorRelation::where('pic_id',$data[0])->delete();
        }else{
            $count=PicColorRelation::where('pic_id',$data[0])->where('color_id',$data[1])->count();
            if($count==0)
            {
                PicColorRelation::create([
                    'pic_id' => $data[0],
                    'color_id' => $data[1],
                ]);
            }
        }
        return response()->json('ثبت موفق');
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
