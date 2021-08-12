<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Logbook;
use App\Models\Logbook_berkas;
use App\Models\Usulan_penelitian;

class LogbookController extends Controller
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

        return view('admin.logbook.index', $view_data);
    }

    // ================================================================================================

    // Logbook Detail
    public function logbook_index($penelitian_id)
    {
        $logbook = Logbook::where('logbook_penelitian_id', $penelitian_id)->orderBy('created_at', 'asc')->get();
        $berkas = Logbook_berkas::where('logbook_berkas_penelitian_id', $penelitian_id)->orderBy('created_at', 'desc')->get();

        $view_data = [
            'logbook' => $logbook,
            'penelitian_id' => $penelitian_id,
            'berkas' => $berkas,
        ];

        return view('admin.logbook.logbook_index', $view_data);
    }

    public function logbook_uraian($penelitian_id, $id)
    {
        $logbook = Logbook::where('logbook_id', $id)->first();

        $view_data = [
            'penelitian_id' => $penelitian_id,
            'logbook' => $logbook,
        ];

        return view('admin.logbook.logbook_uraian', $view_data);
    }
}
