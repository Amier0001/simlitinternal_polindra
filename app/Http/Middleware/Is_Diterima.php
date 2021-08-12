<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Usulan_penelitian;

class Is_Diterima
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
        $penelitian_id = $request->route('penelitian_id');

        $is_diterima = Usulan_penelitian::where('usulan_penelitian_id', $penelitian_id)->first()->usulan_penelitian_status;

        if ($is_diterima == 'selesai') {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Penelitian Sudah Selesai' //Sub Alert Message
            );

            return redirect()->back();
        } elseif ($is_diterima != 'diterima' && $is_diterima != 'selesai') {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Usulan Belum Diterima' //Sub Alert Message
            );

            return redirect()->back();
        } else {
            return $next($request);
        }
    }
}