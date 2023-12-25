<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SortController extends Controller
{
	public function free(Request $request)
    {
        $i=1;
        foreach ($request->data as $item)
        {
            DB::table($request->table)->where('id',$item)->update(['sort' => $i]);
            $i++;
        }
        return response()->json('مرتب سازی انجام شد');
    }
    public function category(Request $request)
    {
        $i=1;
        foreach ($request->data as $item)
        {
            Category::where('id',$item)->update(['sort' => $i]);
            $i++;
        }
        return response()->json('مرتب سازی انجام شد');
    }
    public function color(Request $request)
    {
        $i=1;
        foreach ($request->data as $item)
        {
            Color::where('id',$item)->update(['sort' => $i]);
            $i++;
        }
        return response()->json('مرتب سازی انجام شد');
    }
}
