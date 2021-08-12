<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;

use App\Models\User;

use Closure;

class Is_Suspend
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
        if (Session::get('user_id')) {
            $user = User::where('user_id', Session::get('user_id'))
                ->first();

            if ($user->user_ban == false) {
                return $next($request);
            } else {
                return redirect()->route('suspend');
            }
        } else {
            return redirect()->route('logout');
        }
    }
}