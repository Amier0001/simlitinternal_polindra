<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Jurusan;
use App\Models\Prodi;

class JurusanController extends Controller
{
    // Jurusan
    public function index()
    {
        $jurusan = Jurusan::orderBy('jurusan_nama', 'asc')->get();

        $view_data = [
            'jurusan' => $jurusan,
        ];

        return view('admin.jurusan.index', $view_data);
    }

    public function insert()
    {
        return view('admin.jurusan.insert');
    }

    public function store(Request $request)
    {
        // Input Validation
        $request->validate(
            [
                'name'  => 'required|max:255',
            ],
            [
                'name.required' => "Mohon Isi Nama Jurusan",
                'name.max' => "Nama Jurusan Maksimal 255 Karakter",
            ]
        );

        $name = htmlspecialchars($request->name);

        //check is jurusan exist in DB
        if (Jurusan::where('jurusan_nama', $name)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Nama Jurusan Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'jurusan_nama' => $name,
        ];

        //Insert Data
        Jurusan::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Jurusan Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('admin_jurusan');
    }

    public function edit($id)
    {
        $jurusan = Jurusan::where('jurusan_id', $id)->first();

        $view_data = [
            'jurusan' => $jurusan,
            'id' => $id,
        ];

        return view('admin.jurusan.edit', $view_data);
    }

    public function update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'name'  => 'required|max:255',
            ],
            [
                'name.required' => "Mohon Isi Nama Jurusan",
                'name.max' => "Nama Jurusan Maksimal 255 Karakter",
            ]
        );

        $name = htmlspecialchars($request->name);

        //check is jurusan exist in DB
        if (Jurusan::where('jurusan_nama', $name)->where('jurusan_id', '!=', $id)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Nama Jurusan Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'jurusan_nama' => $name,
        ];

        //Update Data
        Jurusan::where('jurusan_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Jurusan Diubah' //Sub Alert Message
        );

        return redirect()->route('admin_jurusan');
    }

    public function destroy($id)
    {
        Jurusan::destroy('jurusan_id', $id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Jurusan Terhapus' //Sub Alert Message
        );

        return redirect()->route('admin_jurusan');
    }

    // ================================================================================================

    // Prodi
    public function prodi_index($jurusan_id)
    {
        $prodi = Prodi::where('prodi_jurusan_id', $jurusan_id)->orderBy('prodi_nama', 'asc')->get();

        $view_data = [
            'prodi' => $prodi,
            'jurusan_id' => $jurusan_id
        ];

        return view('admin.jurusan.prodi_index', $view_data);
    }

    public function prodi_insert($jurusan_id)
    {
        $view_data = [
            'jurusan_id' => $jurusan_id,
        ];

        return view('admin.jurusan.prodi_insert', $view_data);
    }

    public function prodi_store(Request $request, $jurusan_id)
    {
        // Input Validation
        $request->validate(
            [
                'name'  => 'required|max:255',
            ],
            [
                'name.required' => "Mohon Isi Nama Program Studi",
                'name.max' => "Nama Program Studi Maksimal 255 Karakter",
            ]
        );

        $name = htmlspecialchars($request->name);

        //check is prodi exist in DB
        if (Prodi::where('prodi_nama', $name)->where('prodi_jurusan_id', $jurusan_id)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Nama Program Studi Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'prodi_jurusan_id' => $jurusan_id,
            'prodi_nama' => $name,
        ];

        //Insert Data
        Prodi::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Program Studi Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('admin_prodi', $jurusan_id);
    }

    public function prodi_edit($jurusan_id, $id)
    {
        $prodi = Prodi::where('prodi_id', $id)->first();

        $view_data = [
            'prodi' => $prodi,
            'id' => $id,
            'jurusan_id' => $jurusan_id,
        ];

        return view('admin.jurusan.prodi_edit', $view_data);
    }

    public function prodi_update(Request $request, $jurusan_id, $id)
    {
        // Input Validation
        $request->validate(
            [
                'name'  => 'required|max:255',
            ],
            [
                'name.required' => "Mohon Isi Nama Jurusan",
                'name.max' => "Nama Jurusan Maksimal 255 Karakter",
            ]
        );

        $name = htmlspecialchars($request->name);

        //check is prodi exist in DB
        if (Prodi::where('prodi_nama', $name)->where('prodi_id', '!=', $id)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Nama Program Studi Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'prodi_nama' => $name,
        ];

        //Update Data
        Prodi::where('prodi_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Program Studi Diubah' //Sub Alert Message
        );

        return redirect()->route('admin_prodi', $jurusan_id);
    }

    public function prodi_destroy($jurusan_id, $id)
    {
        Prodi::destroy('prodi_id', $id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Program Studi Terhapus' //Sub Alert Message
        );

        return redirect()->route('admin_prodi', $jurusan_id);
    }
}