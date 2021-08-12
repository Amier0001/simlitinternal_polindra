<?php

namespace App\Http\Middleware;

use Closure;

class Is_Api_Code
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
        if ($request->route('api_code') == '6107fa8fb7e2a6107fad7') {
            return $next($request);
        } else {
            return false;
        }
    }
}