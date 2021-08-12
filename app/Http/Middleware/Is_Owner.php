<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Closure;
use App\Models\Anggota_penelitian;

class Is_Owner
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

        $is_owner = Anggota_penelitian::where('anggota_penelitian_penelitian_id', $penelitian_id)
            ->where('anggota_penelitian_user_id', Session::get('user_id'))
            ->where('anggota_penelitian_role', 'ketua')
            ->count();

        if ($is_owner == 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Anda Bukan Ketua Usulan Ini' //Sub Alert Message
            );

            return redirect()->route('not_found');
        } else {
            return $next($request);
        }
    }
}