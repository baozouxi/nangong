<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

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

        $current_route_name = $request->route()->getName();
        if ($current_route_name == 'admin.login' || $current_route_name == 'admin.loginPost') {
            if(!session()->get('admin-id')){
                return $next($request);
            }else{
                return redirect(route('admin.index'));
            }
        }


        if(!session()->get('admin-id')){
            return redirect(route('admin.login'));
        }


        return $next($request);



    }
}
