<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Bidang;

class BidangController extends Controller
{
     // Bidang
    public function index()
    {
        $bidang = Bidang::orderBy('bidang_label', 'asc')->get();

        $view_data = [
            'bidang' => $bidang,
        ];

        return view('admin.bidang.index', $view_data);
    }

    public function insert()
    {
        return view('admin.bidang.insert');
    }

    public function store(Request $request)
    {
        // Input Validation
        $request->validate(
            [
                'name'  => 'required|max:255',
            ],
            [
                'name.required' => "Mohon Isi Nama Bidang",
                'name.max' => "Nama Bidang Maksimal 255 Karakter",
            ]
        );

        $name = htmlspecialchars($request->name);

        //check is bidang exist in DB
        if (Bidang::where('bidang_label', $name)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Nama Bidang Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'bidang_label' => $name,
        ];

        //Insert Data
        Bidang::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Bidang Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('admin_bidang');
    }

    public function edit($id)
    {
        $bidang = Bidang::where('bidang_id', $id)->first();

        $view_data = [
            'bidang' => $bidang,
            'id' => $id,
        ];

        return view('admin.bidang.edit', $view_data);
    }

    public function update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'name'  => 'required|max:255',
            ],
            [
                'name.required' => "Mohon Isi Nama Bidang",
                'name.max' => "Nama Bidang Maksimal 255 Karakter",
            ]
        );

        $name = htmlspecialchars($request->name);

        //check is bidang exist in DB
        if (Bidang::where('bidang_label', $name)->where('bidang_id', '!=', $id)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Nama Bidang Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'bidang_label' => $name,
        ];

        //Update Data
        Bidang::where('bidang_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Bidang Diubah' //Sub Alert Message
        );

        return redirect()->route('admin_bidang');
    }

    public function destroy($id)
    {
        Bidang::destroy('bidang_id', $id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Bidang Terhapus' //Sub Alert Message
        );

        return redirect()->route('admin_bidang');
    }
}
