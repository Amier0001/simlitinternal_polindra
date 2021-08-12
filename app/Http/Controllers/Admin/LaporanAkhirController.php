<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Usulan_penelitian;

class LaporanAkhirController extends Controller
{
    public function index()
    {
        $laporan_akhir = Usulan_penelitian::where('usulan_penelitian_submit', true)
            ->where('usulan_penelitian_status', 'diterima')
            ->orderBy('usulan_penelitian.updated_at', 'desc')
            ->orderBy('usulan_penelitian_tahun', 'asc')
            ->get();

        $view_data = [
            'laporan_akhir' => $laporan_akhir,
        ];

        return view('admin.laporan_akhir.index', $view_data);
    }
}
