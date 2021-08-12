<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

use Closure;

class Is_Not_Login
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
        if (Session::get('user_id') && Session::get('user_email') && Session::get('user_role')) {
            if (Session::get('user_role') == "admin") {
                //Goto Admin Dashboard
                return redirect()->route('admin_dashboard');
            } else if (Session::get('user_role') == "reviewer") {
                //Goto Reviewer Dashboard
                return redirect()->route('reviewer_dashboard');
            } else if (Session::get('user_role') == "pengusul") {
                //Goto Pengusul Dashboard
                return redirect()->route('pengusul_dashboard');
            }
        } else {
            return $next($request);
        }
    }
}
