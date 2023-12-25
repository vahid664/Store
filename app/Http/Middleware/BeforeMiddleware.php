<?php

namespace App\Http\Middleware;

use App\Redirect;
use Closure;

class BeforeMiddleware
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
        $url=Redirect::where('before',urldecode($request->path()))->first();
        if(isset($url->id))
        {
            if($url->type==1)
            {
                return redirect($url->after,301);
            }
            else{
                session()->flash('canonical',$url->after);
            }
        }
        return $next($request);
    }
}
