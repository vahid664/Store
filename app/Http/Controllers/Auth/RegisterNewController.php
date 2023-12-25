<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterNewController extends Controller
{
    public function register(Request $request)
    {
        $user=User::create([
            'name' => $request->name,
            'family' => $request->family,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $user;
    }
}
