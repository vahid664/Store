<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Faq;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('',compact($request));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $query=$this->ModelElequent($request->all());
        $title=' ثبت faq برای '.$query->title;
        return view('admin.faq.create',compact('title','query','request'));
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
            'id'=> 'required|numeric',
            'question'=> 'required|max:250',
            'status'=> 'required|numeric',
            'answer'=> 'required|min:10',
        ]);
        $query=$this->ModelElequent($request->all());
        $faq=new Faq(array_merge($request->all(),['user_id'=>Auth::user()->id]));
        $query->faqs()->save($faq);
        return redirect()->back()->with('status','ثبت موفق');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function ModelElequent($input)
    {
        switch ($input['model'])
        {
            case 'Product':
                $query=Product::with('faqs')->findOrFail($input['id']);
            break;
            case 'Category':
                $query=Category::with('faqs')->findOrFail($input['id']);
            break;
        }
        return $query;
    }

    public function show($id,Request $request)
    {
        $input=array_merge($request->all(),['id'=>$id]);
        $query=$this->ModelElequent($input);
        //return $query;
        $title='faq های ثبت شده برای '.$query->title;
        return view('admin.faq.index',compact('title','query','request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query=Faq::findOrFail($id);
        //return Arr::last(explode('\\',$query->faqable_type));
        $title=' ویرایش '.$query->question;
        return view('admin.faq.edit',compact('title','query'));
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
        $query=Faq::findOrFail($id);
        $this->validate($request,[
            'question'=> 'required|max:250',
            'status'=> 'required|numeric',
            'answer'=> 'required|min:10',
        ]);
        $query->update($request->all());
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
        $find=Faq::findOrFail($id)->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
