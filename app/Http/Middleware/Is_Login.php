<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

use App\Models\User;

use Closure;

class Is_Login
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
        if (Session::get('user_id') && Session::get('user_role') && Session::get('user_email') && Session::get('user_name')) {
            $user = User::where('user_id', Session::get('user_id'))
                ->where('user_email', Session::get('user_email'))
                ->where('user_role', Session::get('user_role'))
                ->where('user_name', Session::get('user_name'))
                ->first();

            if ($user) {
                return $next($request);
            } else {
                return redirect()->route('logout');
            }
        } else {
            return redirect()->route('logout');
        }
    }
}
