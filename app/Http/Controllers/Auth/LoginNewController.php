<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginNewController extends Controller
{
    public function index()
    {
        return view('auth.login_new');
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['mobile' => $request->mobile , 'password' => $request->password ,'status' => 1]))
        {
            return  redirect('Admin');
        }
        return 'no login';
    }
}
