<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if(Auth::check())
        // {
        //     if(!Auth::user()->is_admin)
        //     {
        //         return redirect()->route('getLogin')->with('error', 'You have to be admin user to access this page');
        //     }
        //     // else
        //     // {
        //     //     return redirect()->route('dashboard')->with('success', 'Welcome Back!');
        //     // }
        // }else{
        //     return redirect()->route('getLogin')->with('error', 'You have to be logged in to access this page');
        // }

        if(!Auth::check())
        {
            return redirect()->route('getLogin')->with('error', 'You have to be logged in to access this page');
        }
        return $next($request);
    }
}
