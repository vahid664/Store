<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\ProvinceCity;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index(Request $request)
    {
        $find=ProvinceCity::where('title',$request->id)->firstOrFail();
        return response()->json($find->childern);
    }
}
