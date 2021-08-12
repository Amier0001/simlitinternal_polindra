<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class WaktuPelaksanaanController extends Controller
{
    // Waktu Pelaksanaan
    public function index()
    {
        $pelaksanaan = get_local_db_json('unlock_feature.json');

        $view_data = [
            'pelaksanaan' => $pelaksanaan,
        ];

        return view('admin.waktu_pelaksanaan.index', $view_data);
    }

    public function edit($id)
    {
        $waktu = get_where_local_db_json("unlock_feature.json", "id", $id);

        $view_data = [
            'waktu' => $waktu,
            'id' => $id,
        ];

        return view('admin.waktu_pelaksanaan.edit', $view_data);
    }

    public function update(Request $request, $id)
    {
        $waktu = explode(" - ", htmlspecialchars($request->waktu));

        $year_start = htmlspecialchars($request->tahun_mulai);
        $year_end = htmlspecialchars($request->tahun_selesai);

        $time_start = date('Y-m-d H:i:s', strtotime($waktu[0]));
        $time_end = date('Y-m-d H:i:s', strtotime($waktu[1]));

        $name = htmlspecialchars($request->name);
        $label = htmlspecialchars($request->label);

        $data = [
            "id" => $request->id,
            "name" => $name,
            "label" => $label,
            "start_year" => $year_start,
            "end_year" => $year_end,
            "start_time" => $time_start,
            "end_time" => $time_end,
        ];

        update_local_db_json("unlock_feature.json", "id", $id, $data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Waktu ' . $label . ' Diubah' //Sub Alert Message
        );

        return redirect()->route('admin_waktu_pelaksanaan');
    }
}
