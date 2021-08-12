<?php

namespace App\Http\Controllers\Pengusul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Models\Usulan_penelitian;
use App\Models\Logbook;
use App\Models\User;
use App\Models\Logbook_berkas;

class LogbookController extends Controller
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
        $tambah_unlock = get_where_local_db_json("unlock_feature.json", "name", __('unlock.tambah_logbook_penelitian'));
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

        return view('pengusul.logbook.index', $view_data);
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

        return view('pengusul.logbook.logbook_index', $view_data);
    }

    public function logbook_uraian($penelitian_id, $id)
    {
        $logbook = Logbook::where('logbook_id', $id)->first();

        $view_data = [
            'penelitian_id' => $penelitian_id,
            'logbook' => $logbook,
        ];

        return view('pengusul.logbook.logbook_uraian', $view_data);
    }


    public function logbook_insert($penelitian_id)
    {
        $view_data = [
            'penelitian_id' => $penelitian_id,
        ];

        return view('pengusul.logbook.logbook_insert', $view_data);
    }

    public function logbook_store(Request $request, $penelitian_id)
    {
        // Input Validation
        $request->validate(
            [
                'tanggal' => 'required',
                'uraian' => 'required|max:4294967200',
                'presentase' => 'required|numeric|min:0|max:100',
            ]
        );

        // $file = $request->file('file');
        // $destination = "assets/file/logbook/";
        $tanggal = htmlspecialchars($request->tanggal);
        $uraian = $request->uraian;
        $presentase = htmlspecialchars($request->presentase);

        //Update Data
        $data = [
            'logbook_penelitian_id' => $penelitian_id,
            // 'logbook_original_name' => $file->getClientOriginalName(),
            // 'logbook_hash_name' => $file->hashName(),
            // 'logbook_base_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            // 'logbook_file_size' => intval($file->getSize() / 1024),
            // 'logbook_extension' => $file->getClientOriginalExtension(),
            // 'logbook_date' => date('Y-m-d H:i:s'),
            'logbook_date' => $tanggal,
            'logbook_uraian_kegiatan' => $uraian,
            'logbook_presentase' => intval($presentase),
        ];

        Logbook::create($data);

        // $file->move($destination, $file->hashName());

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Catatan Kegiatan Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('pengusul_logbook_detail', $penelitian_id);
    }

    public function logbook_edit($penelitian_id, $id)
    {
        $logbook = Logbook::where('logbook_id', $id)->first();

        $view_data = [
            'penelitian_id' => $penelitian_id,
            'logbook' => $logbook,
        ];

        return view('pengusul.logbook.logbook_edit', $view_data);
    }

    public function logbook_update(Request $request, $penelitian_id, $id)
    {
        // Input Validation
        $request->validate(
            [
                'tanggal' => 'required',
                'uraian' => 'required|max:4294967200',
                'presentase' => 'required|numeric|min:0|max:100',
            ]
        );

        // $file = $request->file('file');
        // $destination = "assets/file/logbook/";

        // $fileOld =  Logbook::where('logbook_id', $id)
        //     ->first();

        // $file_path = public_path($destination . $fileOld->laporan_akhir_hash_name);


        // File::delete($file_path);

        $tanggal = htmlspecialchars($request->tanggal);
        $uraian = $request->uraian;
        $presentase = htmlspecialchars($request->presentase);

        //Update Data
        $data = [
            // 'logbook_original_name' => $file->getClientOriginalName(),
            // 'logbook_hash_name' => $file->hashName(),
            // 'logbook_base_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            // 'logbook_file_size' => intval($file->getSize() / 1024),
            // 'logbook_extension' => $file->getClientOriginalExtension(),
            // 'logbook_date' => date('Y-m-d H:i:s'),
            'logbook_date' => $tanggal,
            'logbook_uraian_kegiatan' => $uraian,
            'logbook_presentase' => $presentase,
        ];

        Logbook::where('logbook_id', $id)->update($data);

        // $file->move($destination, $file->hashName());

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Catatan Kegiatan Diubah' //Sub Alert Message
        );

        return redirect()->route('pengusul_logbook_detail', $penelitian_id);
    }

    public function logbook_destroy($penelitian_id, $id)
    {
        $destination = "assets/file/logbook/";

        $fileOld =  Logbook::where('logbook_id', $id)
            ->first();

        $file_path = public_path($destination . $fileOld->laporan_akhir_hash_name);

        File::delete($file_path);

        Logbook::destroy('logbook_id', $id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Dokumen Terhapus' //Sub Alert Message
        );

        return redirect()->route('pengusul_logbook_detail', $penelitian_id);
    }
    // Logbook Berkas
    public function logbook_store_berkas(Request $request, $penelitian_id)
    {
        // Input Validation
        $request->validate(
            [
                'keterangan' => 'required|max:255',
                'file' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:10000',
            ],
            [
                'file.mimes' => 'Tipe File Harus PDF, Word, JPG, JPEG, PNG'
            ]
        );

        $file = $request->file('file');
        $keterangan = $request->keterangan;
        $destination = "assets/file/logbook_berkas/";

        //Update Data
        $data = [
            'logbook_berkas_penelitian_id' => $penelitian_id,
            'logbook_berkas_keterangan' => $keterangan,
            'logbook_berkas_original_name' => $file->getClientOriginalName(),
            'logbook_berkas_hash_name' => $file->hashName(),
            'logbook_berkas_base_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'logbook_berkas_file_size' => intval($file->getSize() / 1024),
            'logbook_berkas_extension' => $file->getClientOriginalExtension(),
            'logbook_berkas_date' => date('Y-m-d'),
        ];

        Logbook_berkas::create($data);

        $file->move($destination, $file->hashName());

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Berkas Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('pengusul_logbook_detail', $penelitian_id);
    }
}
