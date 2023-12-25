<?php

namespace App\Http\Middleware;
use App\Visit;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Closure;
use Illuminate\Support\Arr;

class Visitor
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
        $agent=new Agent();
        $flag_post=0;
       // dd($request->url());
        if(strpos($request->url(),'product') !== false )
        {
            //dd($request->product);
            $id_pro=Arr::first(explode('-',$request->product));
            if(is_numeric($id_pro))
            {
                $flag_post=1;
            }
        }

        Visit::create([
            'user_id' => Auth::check() ? Auth::user()->id : 0,
            'ip' => $request->ip(),
            'system' => $agent->platform(),
            'system_vertion' => $agent->version($agent->platform()),
            'browser' => $agent->browser(),
            'browser_vertion' => $agent->version($agent->browser()),
            'url' => urldecode($request->url()),
            'product_id' => $flag_post == 1 ? $id_pro : 0,
            'time_start' => time(),
            'session_id' => $request->getSession()->getId(),
        ]);
        return $next($request);
    }
}
