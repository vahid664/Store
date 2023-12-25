<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=Role::all();
        $per=DB::table('role_has_permissions')->join('permissions','role_has_permissions.permission_id','=','permissions.id')->get();
        $title='سطوح دسترسی';
        return view('admin.role.index',compact('title','query','per'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions=Permission::all();
        $title='ایجاد سطح دسترسی';
        return view('admin.role.create',compact('title','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $this->validate($request,[
            'name'=>'required|unique:roles|max:20',
            'permissions' =>'required'
        ]);

        $role=Role::create(['name' => $request->name]);

        //return $role;
        foreach ($request->permissions as $value)
        {
            $p=Permission::where('id',$value)->firstOrFail();
            $role=Role::where('name',$request->name)->first();
            $role->givePermissionTo($p->id);
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
    public function edit(Request $request,$id)
    {
        $query=Role::findOrFail($id);
        //return $query->permissions()->pluck('name')->toArray();
        $title=' ویرایش '.$query->name;
        $permissions=Permission::all();
        return view('admin.role.edit',compact('title','query','permissions'));
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
        $role=Role::findOrFail($id);
        $this->validate($request,[
            'name'=>'required|max:20',
            'permissions' =>'required'
        ]);
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->back()->with('status','ویرایش موفق اطلاعات');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find=Role::findOrFail($id);
        $find->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
