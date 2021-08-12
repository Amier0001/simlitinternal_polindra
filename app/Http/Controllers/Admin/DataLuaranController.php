<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Kategori_luaran;
use App\Models\Jenis_luaran;
use App\Models\Status_luaran;

class DataLuaranController extends Controller
{
    public function index()
    {
        $kategori = Kategori_luaran::orderBy('kategori_luaran_required', 'desc')->get();
        $jenis = Jenis_luaran::join('kategori_luaran', 'jenis_luaran.jenis_luaran_kategori_id', '=', 'kategori_luaran.kategori_luaran_id')->orderBy('kategori_luaran.kategori_luaran_required', 'desc')->get();
        $status = Status_luaran::join('kategori_luaran', 'status_luaran.status_luaran_kategori_id', '=', 'kategori_luaran.kategori_luaran_id')->orderBy('kategori_luaran.kategori_luaran_required', 'desc')->get();

        $view_data = [
            'kategori' => $kategori,
            'jenis' => $jenis,
            'status' => $status,
        ];

        return view('admin.data_luaran.index', $view_data);
    }

    // KATEGORI
    public function kategori_insert()
    {
        return view('admin.data_luaran.kategori.insert');
    }

    public function kategori_store(Request $request)
    {
        // Input Validation
        $request->validate(
            [
                'label'  => 'required|max:255',
                'required'  => 'required',
            ],
        );

        $label = htmlspecialchars($request->label);
        $required = htmlspecialchars($request->required);

        //check is jurusan exist in DB
        if (Kategori_luaran::where('kategori_luaran_label', $label)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Nama Kategori Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'kategori_luaran_label' => $label,
            'kategori_luaran_required' => $required,
        ];

        //Insert Data
        Kategori_luaran::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Kategori Luaran Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('admin_data_luaran');
    }

    public function kategori_edit($id)
    {
        $kategori = Kategori_luaran::where('kategori_luaran_id', $id)->first();

        return view('admin.data_luaran.kategori.edit', ['kategori' => $kategori]);
    }

    public function kategori_update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'label'  => 'required|max:255',
                'required'  => 'required',
            ],
        );

        $label = htmlspecialchars($request->label);
        $required = htmlspecialchars($request->required);

        //check is jurusan exist in DB
        if (Kategori_luaran::where('kategori_luaran_label', $label)->where('kategori_luaran_id', '!=', $id)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Nama Kategori Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'kategori_luaran_label' => $label,
            'kategori_luaran_required' => $required,
        ];

        //Insert Data
        Kategori_luaran::where('kategori_luaran_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Kategori Luaran Diubah' //Sub Alert Message
        );

        return redirect()->route('admin_data_luaran');
    }

    public function kategori_destroy($id)
    {
        Kategori_luaran::destroy('kategori_luaran_id', $id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Kategori Luaran Terhapus' //Sub Alert Message
        );

        return redirect()->route('admin_data_luaran');
    }
    // END KATEGORI

    // JENIS
    public function jenis_insert()
    {
        $kategori = Kategori_luaran::orderBy('kategori_luaran_required', 'desc')->get();

        return view('admin.data_luaran.jenis.insert', ['kategori' => $kategori]);
    }

    public function jenis_store(Request $request)
    {
        // Input Validation
        $request->validate(
            [
                'label'  => 'required|max:255',
                'kategori'  => 'required',
            ],
        );

        $label = htmlspecialchars($request->label);
        $kategori = htmlspecialchars($request->kategori);

        //check is jurusan exist in DB
        if (Jenis_luaran::where('jenis_luaran_label', $label)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Nama Jenis Luaran Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'jenis_luaran_kategori_id' => $kategori,
            'jenis_luaran_label' => $label,
        ];

        //Insert Data
        Jenis_luaran::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Jenis Luaran Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('admin_data_luaran')->with('tab', 'jenis');
    }

    public function jenis_edit($id)
    {
        $kategori = Kategori_luaran::orderBy('kategori_luaran_required', 'desc')->get();
        $jenis = Jenis_luaran::where('jenis_luaran_id', $id)->first();

        return view('admin.data_luaran.jenis.edit', ['jenis' => $jenis, 'kategori' => $kategori]);
    }

    public function jenis_update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'label'  => 'required|max:255',
                'kategori'  => 'required',
            ],
        );

        $label = htmlspecialchars($request->label);
        $kategori = htmlspecialchars($request->kategori);

        //check is jurusan exist in DB
        if (Jenis_luaran::where('jenis_luaran_label', $label)->where('jenis_luaran_id', '!=', $id)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Nama Jenis Luaran Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'jenis_luaran_label' => $label,
            'jenis_luaran_kategori_id' => $kategori,
        ];

        //Insert Data
        Jenis_luaran::where('jenis_luaran_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Jenis Luaran Diubah' //Sub Alert Message
        );

        return redirect()->route('admin_data_luaran')->with('tab', 'jenis');
    }

    public function jenis_destroy($id)
    {
        Jenis_luaran::destroy('jenis_luaran_id', $id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Jenis Luaran Terhapus' //Sub Alert Message
        );

        return redirect()->route('admin_data_luaran')->with('tab', 'jenis');
    }
    // END JENIS

    // STATUS
    public function status_insert()
    {
        $kategori = Kategori_luaran::orderBy('kategori_luaran_required', 'desc')->get();

        return view('admin.data_luaran.status.insert', ['kategori' => $kategori]);
    }

    public function status_store(Request $request)
    {
        // Input Validation
        $request->validate(
            [
                'label'  => 'required|max:255',
                'kategori'  => 'required',
            ],
        );

        $label = htmlspecialchars($request->label);
        $kategori = htmlspecialchars($request->kategori);

        //check is jurusan exist in DB
        if (Status_luaran::where('status_luaran_label', $label)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Nama Status Luaran Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'status_luaran_kategori_id' => $kategori,
            'status_luaran_label' => $label,
        ];

        //Insert Data
        Status_luaran::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Status Luaran Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('admin_data_luaran')->with('tab', 'status');
    }

    public function status_edit($id)
    {
        $kategori = Kategori_luaran::orderBy('kategori_luaran_required', 'desc')->get();
        $status = Status_luaran::where('status_luaran_id', $id)->first();

        return view('admin.data_luaran.status.edit', ['status' => $status, 'kategori' => $kategori]);
    }

    public function status_update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'label'  => 'required|max:255',
                'kategori'  => 'required',
            ],
        );

        $label = htmlspecialchars($request->label);
        $kategori = htmlspecialchars($request->kategori);

        //check is jurusan exist in DB
        if (Status_luaran::where('status_luaran_label', $label)->where('status_luaran_id', '!=', $id)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Nama Status Luaran Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'status_luaran_label' => $label,
            'status_luaran_kategori_id' => $kategori,
        ];

        //Update Data
        Status_luaran::where('status_luaran_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Status Luaran Diubah' //Sub Alert Message
        );

        return redirect()->route('admin_data_luaran')->with('tab', 'status');
    }

    public function status_destroy($id)
    {
        Status_luaran::destroy('status_luaran_id', $id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Status Luaran Terhapus' //Sub Alert Message
        );

        return redirect()->route('admin_data_luaran')->with('tab', 'status');
    }
    // END STATUS
}

