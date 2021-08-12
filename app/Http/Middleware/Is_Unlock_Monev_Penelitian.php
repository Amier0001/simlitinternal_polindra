<?php

namespace App\Http\Middleware;

use Closure;

class Is_Unlock_Monev_Penelitian
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
        $nilai_unlock = get_where_local_db_json("unlock_feature.json", "name", __('unlock.monev_laporan_kemajuan_penelitian'));

        if ($nilai_unlock) {
            if (strtotime($nilai_unlock["start_time"]) <= strtotime(date('Y-m-d H:i:s')) &&  strtotime(date('Y-m-d H:i:s')) <= strtotime($nilai_unlock["end_time"])) {
                return $next($request);
            } else {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Akses Ditutup', //Alert Message 
                    'Akses Belum Dibuka' //Sub Alert Message
                );

                return redirect()->route('reviewer_monev');
            }
        }
    }
}
