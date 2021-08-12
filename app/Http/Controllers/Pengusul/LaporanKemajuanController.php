<?php

namespace App\Http\Controllers\Pengusul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Models\Usulan_penelitian;
use App\Models\User;
use App\Models\Usulan_luaran;
use App\Models\Laporan_kemajuan;
use App\Models\Laporan_luaran;

class LaporanKemajuanController extends Controller
{
    public function index()
    {
        $penelitian = Usulan_penelitian::whereHas('anggota_penelitian', function ($query) {
            $query->where('anggota_penelitian_user_id', Session::get('user_id'))
                ->where('anggota_penelitian_role', "ketua");
        })
            ->where('usulan_penelitian_submit', true)
            ->where('usulan_penelitian_status', 'diterima')
            ->orderBy('usulan_penelitian.updated_at', 'desc')
            ->orderBy('usulan_penelitian_tahun', 'asc')
            ->get();

        $is_tambah_unlock = false;
        $tambah_unlock = get_where_local_db_json("unlock_feature.json", "name", __('unlock.tambah_laporan_kemajuan_penelitian'));
        if ($tambah_unlock) {
            if (strtotime($tambah_unlock["start_time"]) <= strtotime(date('Y-m-d H:i:s')) &&  strtotime(date('Y-m-d H:i:s')) <= strtotime($tambah_unlock["end_time"])) {
                $is_tambah_unlock = true;
            }
        }

        $is_suspend = User::find(Session::get('user_id'))->user_ban;

        $view_data = [
            'is_suspend' => $is_suspend,
            'penelitian' => $penelitian,
            'is_tambah_unlock' => $is_tambah_unlock,
            'tambah_unlock' => $tambah_unlock,
        ];

        return view('pengusul.laporan_kemajuan.index', $view_data);
    }
    
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

        return view('pengusul.laporan_kemajuan.laporan_kemajuan', $view_data);
    }

    public function insert($penelitian_id, $id, $tipe)
    {
        $view_data = [
            'tipe' => $tipe,
            'id' => $id,
            'penelitian_id' => $penelitian_id,
        ];

        return view('pengusul.laporan_kemajuan.insert', $view_data);
    }

    public function store(Request $request, $penelitian_id, $id, $tipe)
    {
        // Input Validation
        $request->validate(
            [
                'file' => 'required',
                'file.*'  => 'required|mimes:doc,docx,pdf,xls,xlsx|max:10000',
            ],
            [
                'file.*.mimes' => 'File harus bertipe:doc, docx, pdf, xls, xlsx'
            ]
        );

        $file = $request->file('file');
        $penelitian_id = $penelitian_id;
        $tipe = $tipe;
        $user_id = $request->session()->get('user_id');
        $original_name = $file->getClientOriginalName();
        $hash_name = $file->hashName();
        $base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_size = intval($file->getSize() / 1024);
        $extension = $file->getClientOriginalExtension();
        
        $destination = NULL;

        // ====
        if ($tipe == 'luaran') {
            $destination = "assets/file/laporan_luaran/";

            $is_exist = Laporan_luaran::where('laporan_luaran_luaran_id', $id)
                ->count();

            if ($is_exist > 0) {
                $fileOld =  Laporan_luaran::where('laporan_luaran_luaran_id', $id)
                    ->first();

                $file_path = public_path($destination . $fileOld->laporan_luaran_hash_name);

                $file->move($destination, $file->hashName());

                File::delete($file_path);
            } else {
                $file->move($destination, $file->hashName());
            }

            //Insert Data
            $data = [
                'laporan_luaran_luaran_id' => $id,
                'laporan_luaran_date' => date('Y-m-d'),
                'laporan_luaran_original_name' => $original_name,
                'laporan_luaran_hash_name' => $hash_name,
                'laporan_luaran_base_name' => $base_name,
                'laporan_luaran_file_size' => $file_size,
                'laporan_luaran_extension' => $extension,
            ];
            Laporan_luaran::updateOrInsert(
                ['laporan_luaran_luaran_id' => $id],
                $data
            );
        } elseif ($tipe == 'kemajuan' || $tipe == 'keuangan') {
            $destination = "assets/file/laporan_kemajuan/";
            $type = ($tipe == 'kemajuan') ? 'kemajuan' : 'keuangan';

            if ($id == 0) {
                $file->move($destination, $file->hashName());

                //Insert Data
                $data = [
                    'laporan_kemajuan_penelitian_id' => $penelitian_id,
                    'laporan_kemajuan_date' => date('Y-m-d'),
                    'laporan_kemajuan_tipe' => $type,
                    'laporan_kemajuan_original_name' => $original_name,
                    'laporan_kemajuan_hash_name' => $hash_name,
                    'laporan_kemajuan_base_name' => $base_name,
                    'laporan_kemajuan_file_size' => $file_size,
                    'laporan_kemajuan_extension' => $extension,
                ];

                Laporan_kemajuan::create(
                    $data
                );
            } else {
                $fileOld =  Laporan_kemajuan::where('laporan_kemajuan_id', $id)
                    ->first();

                $file_path = public_path($destination . $fileOld->laporan_kemajuan_hash_name);

                $file->move($destination, $file->hashName());

                File::delete($file_path);

                //Update Data
                $data = [
                    'laporan_kemajuan_date' => date('Y-m-d'),
                    'laporan_kemajuan_original_name' => $original_name,
                    'laporan_kemajuan_hash_name' => $hash_name,
                    'laporan_kemajuan_base_name' => $base_name,
                    'laporan_kemajuan_file_size' => $file_size,
                    'laporan_kemajuan_extension' => $extension,
                ];

                Laporan_kemajuan::where('laporan_kemajuan_id', $id)
                    ->update(
                        $data
                    );
            }

        } else {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Galat', //Alert Message 
                'Kelas File Salah' //Sub Alert Message
            );

            return redirect()->route('pengusul_laporan_kemajuan_list', $penelitian_id);
        }

        

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'File Laporan Terunggah' //Sub Alert Message
        );

        return redirect()->route('pengusul_laporan_kemajuan_list', $penelitian_id);
    }
    
}
