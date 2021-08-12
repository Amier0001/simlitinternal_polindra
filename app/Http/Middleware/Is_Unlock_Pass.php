<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Usulan_penelitian;

class Is_Unlock_Pass
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
        // $unlock_pass = Usulan_penelitian::where('');

        // if ($tambah_unlock) {
        //     if (strtotime($tambah_unlock["start_time"]) <= strtotime(date('Y-m-d H:i:s')) &&  strtotime(date('Y-m-d H:i:s')) <= strtotime($tambah_unlock["end_time"])) {
        //         return $next($request);
        //     }
        // }
    }
}