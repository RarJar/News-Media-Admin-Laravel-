<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(!empty(Auth::user())){
            // If we go Login Page && Register page from login stated
            if(url()->current() == route('#loginPage') || url()->current() == route('#registerPage')){
                return back();
            }

            return $next($request);
        }

        return $next($request);
    }
}
