<?php

namespace App\Http\Controllers\Pengusul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Models\Laporan_akhir;
use App\Models\Usulan_penelitian;
use App\Models\User;


class LaporanAkhirController extends Controller
{
    public function index()
    {
        $laporan_akhir = Usulan_penelitian::whereHas('anggota_penelitian', function ($query) {
            $query->where('anggota_penelitian_user_id', Session::get('user_id'))
                ->where('anggota_penelitian_role', "ketua");
        })
            ->where('usulan_penelitian_submit', true)
            ->where('usulan_penelitian_status', 'diterima')
            ->orderBy('usulan_penelitian.updated_at', 'desc')
            ->orderBy('usulan_penelitian_tahun', 'asc')
            ->get();
        
        $is_tambah_unlock = false;
        $tambah_unlock = get_where_local_db_json("unlock_feature.json", "name", __('unlock.tambah_laporan_akhir_penelitian'));
        if ($tambah_unlock) {
            if (strtotime($tambah_unlock["start_time"]) <= strtotime(date('Y-m-d H:i:s')) &&  strtotime(date('Y-m-d H:i:s')) <= strtotime($tambah_unlock["end_time"])) {
                $is_tambah_unlock = true;
            }
        }

        $is_suspend = User::find(Session::get('user_id'))->user_ban;

        $view_data = [
            'is_suspend' => $is_suspend,
            'laporan_akhir' => $laporan_akhir,
            'is_tambah_unlock' => $is_tambah_unlock,
            'tambah_unlock' => $tambah_unlock,
        ];

        return view('pengusul.laporan_akhir.index', $view_data);
    }

    public function insert()
    {
        return view('pengusul.laporan_akhir.insert');
    }

    public function store(Request $request)
    {
    }

    public function update(Request $request)
    {
        $id = $request->penelitian_id;
        $is_diterima = Usulan_penelitian::where('usulan_penelitian_id', $id)->first()->usulan_penelitian_status;

        if ($is_diterima == 'selesai') {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Pengabdian Sudah Selesai' //Sub Alert Message
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
        }

        $request->validate(
            [
                'laporan_akhir' => 'required|mimes:pdf|max:10000',
            ],
            [
                'laporan_akhir.mimes' => 'Tipe File Harus PDF'
            ]
        );

        $file = $request->file('laporan_akhir');
        $destination = "assets/file/laporan_akhir/";
        $id = $request->penelitian_id;
        $file_original_name = $file->getClientOriginalName();
        $file_hash_name = $file->hashName();
        $file_base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_size = intval($file->getSize() / 1024);
        $file_extension = $file->getClientOriginalExtension();

        $is_exist = Laporan_akhir::where('laporan_akhir_penelitian_id', $id)
            ->count();

        if ($is_exist > 0) {
            $fileOld =  Laporan_akhir::where('laporan_akhir_penelitian_id', $id)
                ->first();

            $file_path = public_path($destination . $fileOld->laporan_akhir_hash_name);

            $file->move($destination, $file->hashName());

            File::delete($file_path);
        } else {
            $file->move($destination, $file->hashName());
        }

        //Update Data
        $data = [
            'laporan_akhir_penelitian_id' => $id,
            'laporan_akhir_original_name' => $file_original_name,
            'laporan_akhir_hash_name' => $file_hash_name,
            'laporan_akhir_base_name' => $file_base_name,
            'laporan_akhir_file_size' => $file_size,
            'laporan_akhir_extension' => $file_extension,
            'laporan_akhir_date' => date('Y-m-d'),
        ];

        Laporan_akhir::updateOrInsert(
            ['laporan_akhir_penelitian_id' => $id],
            $data
        );

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Laporan Akhir Terunggah' //Sub Alert Message
        );

        return redirect()->back();
    }
}
