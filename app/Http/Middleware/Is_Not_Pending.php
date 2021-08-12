<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Usulan_penelitian;

class Is_Not_Pending
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
        $penelitian_id = $request->route('id');

        $is_diterima = Usulan_penelitian::where('usulan_penelitian_id', $penelitian_id)->first();

        if ($is_diterima) {
            if ($is_diterima->usulan_penelitian_status != 'pending') {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Gagal', //Alert Message 
                    'Usulan Penelitian Sudah Dikirim' //Sub Alert Message
                );

                return redirect()->route('pengusul_penelitian');
            } else {
                return $next($request);
            }
        } else {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Usulan Penelitian Salah' //Sub Alert Message
            );

            return redirect()->route('pengusul_penelitian');
        }
    }
}