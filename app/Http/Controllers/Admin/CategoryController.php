<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='لیست دسته بندی';
        return view('admin.category.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='افزودن دسته بندی جدید';
        return view('admin.category.create',compact('title'));
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
            'title' => 'required|min:2|max:255|unique:categories',
            'title_en' => 'required|min:2|max:255|unique:categories',
            'title_page' => 'required|min:2|max:255|unique:categories',
            'pic' => 'nullable|mimes:jpg,jpeg,png,gif|max:10240',
            'pic_alt' => 'nullable|min:2|max:255',
            'keywords' => 'nullable|min:2|max:255',
            'description' => 'nullable|min:2|max:255',
            'status' => 'required|numeric',
            'menu' => 'required|numeric',
            'text' => 'nullable|min:2|max:400000',
            'parent' => 'required|numeric',
        ]);


        $category=Category::create(array_merge($request->except('pic'),['user_id'=> Auth::user()->id]));
        if($request->hasFile('pic'))
        {
            $destination= base_path().'/public/upload/category/'.date('Y').'/'.date('m');
            if(!is_dir($destination))
            {
                mkdir($destination,0777,true);
            }
            $destination=$destination.'/';
            $filename=rand(1111111,99999999);
            $file=$request->file('pic');
            $file->move($destination,$filename.'.'.$request->pic->getClientOriginalExtension());
            $category->update(['pic' => '/upload/category/'.date('Y').'/'.date('m').'/'.$filename.'.'.$request->pic->getClientOriginalExtension()]);
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
        $query=Category::where('parent',$id)->orderBy('sort')->get();
        echo ' <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th> عنوان</th>
                                    <th>توضیحات</th>
                                    <th>وضعیت </th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody class="sortable-list connectList agile-list" id="todo">';
        $i=1;
        foreach($query as $item)
        {
            echo ' <tr id="'.$item->id.'" class="gradeX data'.$item->id.'">';
            echo '<td class="align-middle">'.$i.'</td>
                <td class="align-middle">'.$item->title.'</td>
                <td class="align-middle">'.$item->description.'</td>
                <td class="align-middle text-center">';
            if($item->status==1)
            {
                echo '<span class="badge badge-success p-2">فعال</span>';
            }else{
                echo '<span class="badge badge-danger p-2">غیرفعال</span>';
            }
            echo '</td>
                    <td class="align-middle">';

            if(Auth::user()->hasPermissionTo(Helper::getTypePermission('delete')))
            {
                echo ' <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del'.$item->id.'" data-url="'.url('Admin/Category/'.$item->id).'"
                     onclick="del('.$item->id.');">
                        <i class="fa fa-trash"></i>
                    </button>';
            }

            if(Auth::user()->hasPermissionTo(Helper::getTypePermission('edit')))
            {
                echo '
                    <a title="ویرایش" href="'.url('Admin/Category/'.$item->id.'/edit').'" class="btn btn-outline-success btn-sm">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>';
            }

            if(Auth::user()->hasPermissionTo(Helper::getTypePermission('edit')))
            {
                echo '<a title="کپی" href="'.route('CopyProCat.index',['id'=> $item->id]).'" class="btn btn-success btn-sm">
                        <i class="fa fa-copy"></i>
                    </a>';
            }
            if(Auth::user()->hasPermissionTo(Helper::getTypePermission('show')))
            {
                echo '<a title="faq" href="'.route('Faq.show',[$item->id,'model=Category']).'"
                           class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-comment"></i>
                        </a>';
            }

            echo '</td>
                </tr>';
            $i++;
        }

        echo ' </tbody></table>';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query=Category::findOrFail($id);
        $title=' ویرایش '.$query->title;
        return view('admin.category.edit',compact('title','query'));
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
        $category=Category::findOrFail($id);
        $this->validate($request,[
            'title' => 'required|min:2|max:255',
            'title_en' => 'required|min:2|max:255',
            'title_page' => 'required|min:2|max:255',
            'pic' => 'nullable|mimes:jpg,jpeg,png,gif|max:10240',
            'pic_alt' => 'nullable|min:2|max:255',
            'keywords' => 'nullable|min:2|max:255',
            'description' => 'nullable|min:2|max:255',
            'status' => 'required|numeric',
            'menu' => 'required|numeric',
            'text' => 'nullable|min:2|max:400000',
            'parent' => 'required|numeric',
        ]);


        $category->update($request->except('pic'));
        if($request->hasFile('pic'))
        {
            $destinationbefore = base_path() . '/public/'.$category->pic;
            //return $destinationbefore;
            if(file_exists($destinationbefore) && $category->file != '')
            {
                unlink($destinationbefore);
            }

            $destination= base_path().'/public/upload/category/'.date('Y').'/'.date('m');
            if(!is_dir($destination))
            {
                mkdir($destination,0777,true);
            }
            $destination=$destination.'/';
            $filename=rand(1111111,99999999);
            $file=$request->file('pic');
            $file->move($destination,$filename.'.'.$request->pic->getClientOriginalExtension());
            $category->update(['pic' => '/upload/category/'.date('Y').'/'.date('m').'/'.$filename.'.'.$request->pic->getClientOriginalExtension()]);
        }

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
        $find=Category::findOrFail($id);
        $array_of_ids = $this->getChildren($find);
        array_push($array_of_ids, $id);
        Category::destroy($array_of_ids);
        return response()->json('حذف موفق اطلاعات');
    }

    private function getChildren($category){
        $ids = [];
        foreach ($category->childern as $cat) {
            $ids[] = $cat->id;
            $ids = array_merge($ids, $this->getChildren($cat));
        }
        return $ids;
    }
}
