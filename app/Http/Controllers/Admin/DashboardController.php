<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Usulan_penelitian;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_pengusul = User::where('user_role', 'pengusul')->count();
        $jumlah_reviewer = User::where('user_role', 'reviewer')->count();
        $jumlah_usulan_total = Usulan_penelitian::where('usulan_penelitian_status', '!=', 'pending')->count();
        $jumlah_usulan_tahun_ini = Usulan_penelitian::where('usulan_penelitian_tahun', date('Y'))
            ->where('usulan_penelitian_status', '!=', 'pending')
            ->count();

        $view_data = [
            'jumlah_pengusul' => $jumlah_pengusul,
            'jumlah_reviewer' => $jumlah_reviewer,
            'jumlah_usulan_total' => $jumlah_usulan_total,
            'jumlah_usulan_tahun_ini' => $jumlah_usulan_tahun_ini,
        ];

        return view('admin.dashboard.dashboard_admin', $view_data);
    }
}
