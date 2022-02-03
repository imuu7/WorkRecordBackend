<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class TokenCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth()->user()) {
            if (Auth()->user()->stoken == null || Auth()->user()->stoken == '') {
                $md5_str = Auth()->user()->email.time();
                Auth()->user()->stoken = md5($md5_str);
                Auth()->user()->save();
                return $next($request);
            }else{
                return $next($request);
            }
        }else{
            return $next($request);
        }
    }
}
