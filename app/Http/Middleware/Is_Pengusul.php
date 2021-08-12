<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;

use App\Models\User;

use Closure;

class Is_Pengusul
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
        $role = User::where('user_id', Session::get('user_id'))->first()->user_role;
        if ($role == "pengusul") {
            return $next($request);
        } else {
            return redirect()->route('forbidden');
        }
    }
}
