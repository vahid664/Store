<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //return $next($request);
        if(!Auth::check())
        {
            return redirect('login')->withErrors('dont_login','این مسیر موجود نمی باشد!!!');
        }
        if(Auth::user()->level != 121)
        {
            return redirect('login')->withErrors('dont_login','این مسیر موجود نمی باشد!!!');
        }
        return $next($request);
    }
}
