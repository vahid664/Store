<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='کاربران';
        $query=User::where('level',0)->orderByDesc('id')->get();
        return view('admin.user.index',compact('title','query'));
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
        $query=User::findOrFail($id);
        $title='ویرایش کاربری '.$query->full_name;
        //return $title;
        $roles=Role::all();
        $role_has=DB::table('model_has_roles')->where('model_id',$id)->select('role_id')->get()->pluck('role_id')->toArray();
        return view('admin.user.edit',compact('title','query','roles','role_has'));
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
        $user=User::findOrFail($id);
        $this->validate($request,[
            'name'=>'required|max:120',
            'family'=>'required|max:120',
            'mobile'=>'required|digits:11|numeric',
            'email'=>'nullable|email',
            'level'=>'required|numeric',
            'password'=>'nullable|min:8|confirmed'
        ]);

        $input='';
        if(isset($request->password))
        {
            $input=$request->except('roles');
            $input['password']=bcrypt($input['password']);
        }
        else
        {
            $input=$request->except(['roles','password']);
        }

        $user->update($input);
        if (isset($request->roles))
        {
            $user->roles()->sync($request->roles);
        }
        else
        {
            $user->roles()->detach();
        }
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
        $find=User::findOrFail($id);
        $find->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
