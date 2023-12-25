<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CheckPermission
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
        $route=$request->route()->getName();
        if($route != null)
        {
            $route=strtolower(Arr::first(explode('.',$route)));
        }
        else
        {
            return $next($request);
        }
        if($request->route()->getActionMethod() == 'index')
        {
            if(!Auth::user()->hasPermissionTo($route.'-index'))
            {
                abort(401);
            }
            else
            {
                return $next($request);
            }
        }

        if($request->route()->getActionMethod() == 'create')
        {
            if(!Auth::user()->hasPermissionTo($route.'-create'))
            {
                abort(401);
            }
            else
            {
                return $next($request);
            }
        }
        if($request->route()->getActionMethod() == 'store')
        {
            if(!Auth::user()->hasPermissionTo($route.'-store'))
            {
                abort(401);
            }
            else
            {
                return $next($request);
            }
        }

        if($request->route()->getActionMethod() == 'show')
        {
            if(!Auth::user()->hasPermissionTo($route.'-show'))
            {
                abort(401);
            }
            else
            {
                return $next($request);
            }
        }

        if($request->route()->getActionMethod() == 'edit')
        {
            if(!Auth::user()->hasPermissionTo($route.'-edit'))
            {
                abort(401);
            }
            else
            {
                return $next($request);
            }
        }
        if($request->route()->getActionMethod() == 'update')
        {
            if(!Auth::user()->hasPermissionTo($route.'-update'))
            {
                abort(401);
            }
            else
            {
                return $next($request);
            }
        }

        if($request->isMethod('Delete'))
        {
            if(!Auth::user()->hasPermissionTo($route.'-delete'))
            {
                abort(401);
            }
            else
            {
                return $next($request);
            }
        }
    }
}
