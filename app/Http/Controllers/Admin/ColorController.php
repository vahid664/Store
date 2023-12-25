<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='رنگ محصولات';
        $query=Color::orderByDesc('id')->paginate(1000);
        return view('admin.color.index',compact('title','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='افزودن رنگ جدید';
        return view('admin.color.create',compact('title'));
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
            'title' => 'required|min:2|max:255',
            'title_factory' => 'required|min:2|max:255',
            'color' => 'required',
            'parent' => 'required|numeric',
        ]);
        Color::create(array_merge($request->all(),['user_id'=> Auth::user()->id]));
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
        $query=Color::where('parent',$id)->orderBy('sort')->get();
        echo ' <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th> عنوان</th>
                                    <th>عنوان کارخانه</th>
                                    <th>کد رنگ </th>
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
                <td class="align-middle">'.$item->title_factory.'</td>
                <td class="align-middle"><span style="background-color: '.$item->color.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>';

            echo '<td class="align-middle">';

            if(Auth::user()->hasPermissionTo(Helper::getTypePermission('delete')))
            {
                echo ' <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del'.$item->id.'" data-url="'.url('Admin/Color/'.$item->id).'"
                     onclick="del('.$item->id.');">
                        <i class="fa fa-trash"></i>
                    </button>';
            }

           /* if(Auth::user()->hasPermissionTo(Helper::getTypePermission('edit')))
            {
                echo '
                    <a title="ویرایش" href="'.url('Admin/Color/'.$item->id.'/edit').'" class="btn btn-outline-success btn-sm">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>';
            }*/



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
        $find=Color::findOrFail($id);
        $array_of_ids = $this->getChildren($find);
        array_push($array_of_ids, $id);
        Color::destroy($array_of_ids);
        return response()->json('حذف موفق اطلاعات');
    }
    private function getChildren($category){
        $ids = [];
        foreach ($category->child as $cat) {
            $ids[] = $cat->id;
            $ids = array_merge($ids, $this->getChildren($cat));
        }
        return $ids;
    }
}
