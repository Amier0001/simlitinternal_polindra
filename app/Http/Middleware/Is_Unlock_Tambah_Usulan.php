<?php

namespace App\Http\Middleware;

use Closure;

class Is_Unlock_Tambah_Usulan
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
        $tambah_unlock = get_where_local_db_json("unlock_feature.json", "name", __('unlock.tambah_usulan_penelitian'));

        if ($tambah_unlock) {
            if (strtotime($tambah_unlock["start_time"]) <= strtotime(date('Y-m-d H:i:s')) &&  strtotime(date('Y-m-d H:i:s')) <= strtotime($tambah_unlock["end_time"])) {
                return $next($request);
            } else {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Akses Ditutup', //Alert Message 
                    'Akses Belum Dibuka' //Sub Alert Message
                );

                return redirect()->route('pengusul_penelitian');
            }
        }
    }
}
