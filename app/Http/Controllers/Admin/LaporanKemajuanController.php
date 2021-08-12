<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Laporan_kemajuan;
use App\Models\Usulan_penelitian;
use App\Models\Usulan_luaran;

class LaporanKemajuanController extends Controller
{
    public function index()
    {
        $penelitian = Usulan_penelitian::where('usulan_penelitian_submit', true)
            ->where('usulan_penelitian_status', 'diterima')
            ->orderBy('usulan_penelitian.updated_at', 'desc')
            ->orderBy('usulan_penelitian_tahun', 'asc')
            ->get();

        $view_data = [
            'penelitian' => $penelitian,
        ];

        return view('admin.laporan_kemajuan.index', $view_data);
    }

    // ==================================================================================

    public function list($penelitian_id)
    {
        $laporan_kemajuan = Laporan_kemajuan::where('laporan_kemajuan_penelitian_id', $penelitian_id)->where('laporan_kemajuan_tipe', 'kemajuan')->first();

        $laporan_keuangan = Laporan_kemajuan::where('laporan_kemajuan_penelitian_id', $penelitian_id)->where('laporan_kemajuan_tipe', 'keuangan')->first();

        $luaran_wajib = Usulan_luaran::where('usulan_luaran_penelitian_id', $penelitian_id)
            ->where('usulan_luaran_penelitian_tipe', 'wajib')
            ->get();

        $luaran_tambahan = Usulan_luaran::where('usulan_luaran_penelitian_id', $penelitian_id)
            ->where('usulan_luaran_penelitian_tipe', 'tambahan')
            ->get();

        $view_data = [
            'laporan_kemajuan' => $laporan_kemajuan,
            'laporan_keuangan' => $laporan_keuangan,
            'luaran_wajib' => $luaran_wajib,
            'luaran_tambahan' => $luaran_tambahan,
            'penelitian_id' => $penelitian_id,
        ];

        return view('admin.laporan_kemajuan.list', $view_data);
    }
}

