<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Lama_kegiatan;

class LamaKegiatanController extends Controller
{
     // Lama Kegiatan
    public function index()
    {
        $lama = Lama_kegiatan::orderBy('lama_kegiatan_tahun', 'asc')->get();

        $view_data = [
            'lama' => $lama,
        ];

        return view('admin.lama_kegiatan.index', $view_data);
    }

    public function insert()
    {
        return view('admin.lama_kegiatan.insert');
    }

    public function store(Request $request)
    {
        // Input Validation
        $request->validate(
            [
                'lama'  => 'required|min:1|max:11|numeric',
            ],
            [
                'lama.required' => "Mohon Isi Lama Kegiatan",
                'lama.min' => "Angka Minimal 1 Karakter",
                'lama.max' => "Angka Maksimal 11 Karakter",
                'lama.numeric' => "Lama Kegiatan Harus Angka",
            ]
        );

        $lama = htmlspecialchars($request->lama);

        //check is lama exist in DB
        if (Lama_kegiatan::where('lama_kegiatan_tahun', $lama)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Angka Lama Kegiatan Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'lama_kegiatan_tahun' => $lama,
        ];

        //Insert Data
        Lama_kegiatan::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Lama Kegiatan Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('admin_lama_kegiatan');
    }

    public function edit($id)
    {
        $lama = Lama_kegiatan::where('lama_kegiatan_id', $id)->first();

        $view_data = [
            'lama' => $lama,
            'id' => $id,
        ];

        return view('admin.lama_kegiatan.edit', $view_data);
    }

    public function update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'lama'  => 'required|min:1|max:11|numeric',
            ],
            [
                'lama.required' => "Mohon Isi Lama Kegiatan",
                'lama.min' => "Angka Minimal 1 Karakter",
                'lama.max' => "Angka Maksimal 11 Karakter",
                'lama.numeric' => "Lama Kegiatan Harus Angka",
            ]
        );

        $lama = htmlspecialchars($request->lama);

        //check is lama exist in DB
        if (Lama_kegiatan::where('lama_kegiatan_tahun', $lama)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Angka Lama Kegiatan Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'lama_kegiatan_tahun' => $lama,
        ];

        //Update Data
        Lama_kegiatan::where('lama_kegiatan_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Lama Kegiatan Diubah' //Sub Alert Message
        );

        return redirect()->route('admin_lama_kegiatan');
    }

    public function destroy($id)
    {
        Lama_kegiatan::destroy('lama_kegiatan_id', $id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Lama Kegiatan Terhapus' //Sub Alert Message
        );

        return redirect()->route('admin_lama_kegiatan');
    }
}
