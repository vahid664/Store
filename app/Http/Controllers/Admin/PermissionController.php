<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
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
        $query=Permission::orderByDesc('id')->get();
        $title='دسترسی ها';
        return view('admin.permission.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='افزودن دسترسی';
        $roles=Role::all();
        return view('admin.permission.create',compact('title','roles'));
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
            'name' => 'required|string|max:50',
            'title' => 'required|string|max:50'
        ]);

        Permission::create([
            'name' => $request->name,
            'title' => $request->title
        ]);

        if(isset($request->roles))
        {
            foreach ($request->roles as $value)
            {
                $r =Role::where('id',$value)->firstOrFail();
                $permission=Permission::where('name',$request->name)->first();
                $r->givePermissionTo($permission);
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
        $query=Permission::findOrFail($id);
        $title=' ویرایش '.$query->name;
        $role_has=DB::table('role_has_permissions')->where('permission_id',$id)->select('role_id')->get()->pluck('role_id')->toArray();
        //return $role_has;
        return view('admin.permission.edit',compact('title','query','role_has'));
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
        $permission=Permission::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|string|max:40',
            'title' => 'required|string|max:50'
        ]);
        $permission->update(['name' => $request->name , 'title' => $request->title]);

        $permission->syncRoles($request->roles);
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
        $find=Permission::findOrFail($id);
        $find->delete();
        return response()->json('حذف موفق اطلاعات');
    }
}
