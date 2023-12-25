<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Jobs\SendRequestEmail;
use App\User;
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
        $query=Comment::orderByDesc('id')->paginate(2000);
        $title='نظرات';
        return view('admin.comment.index',compact('title','query'));
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
        $query=Comment::findOrFail($id);
        $title=' ویرایش '.$query->title;
        return view('admin.comment.edit',compact('title','query'));
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
        $find=Comment::findOrFail($id);
        $user = User::findOrFail($find->user_id);
        if($request->accept == 1)
        {
            Comment::where('commentable_id',$find->commentable_id)->update(['accept' => 0]);
        }
        if ($request->status == 1 && $find->status == 0){
            $this->dispatch(new SendRequestEmail($user->email));
        }

        $find->update(array_merge($request->all(),['admin_id'=> Auth::user()->id]));



        return redirect()->back()->with('status','به روز رسانی موفق');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find=Comment::findOrFail($id);
        $find->delete();
        return response()->json('حذف موفق');
    }
}
