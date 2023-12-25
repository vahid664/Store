<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        //return $request->all();
        $this->validate($request,[
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if(Auth::attempt(['email' => $request->email , 'password' => $request->password]))
        {
            return response()->json('ورود به حساب کاربری');
        }

        return response()->json('نام کاربری یا پسورد ورودی اشتباه می باشد',401);
    }
}
