<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Skema;

class SkemaController extends Controller
{
     // Skema
    public function index()
    {
        $skema = Skema::orderBy('skema_label', 'asc')->get();

        $view_data = [
            'skema' => $skema,
        ];

        return view('admin.skema.index', $view_data);
    }

    public function insert()
    {
        return view('admin.skema.insert');
    }

    public function store(Request $request)
    {
        // Input Validation
        $request->validate(
            [
                'name'  => 'required|max:255',
            ],
            [
                'name.required' => "Mohon Isi Nama skema",
                'name.max' => "Nama skema Maksimal 255 Karakter",
            ]
        );

        $name = htmlspecialchars($request->name);

        //check is skema exist in DB
        if (Skema::where('skema_label', $name)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Nama skema Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'skema_label' => $name,
        ];

        //Insert Data
        Skema::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'skema Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('admin_skema');
    }

    public function edit($id)
    {
        $skema = Skema::where('skema_id', $id)->first();

        $view_data = [
            'skema' => $skema,
            'id' => $id,
        ];

        return view('admin.skema.edit', $view_data);
    }

    public function update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'name'  => 'required|max:255',
            ],
            [
                'name.required' => "Mohon Isi Nama skema",
                'name.max' => "Nama skema Maksimal 255 Karakter",
            ]
        );

        $name = htmlspecialchars($request->name);

        //check is skema exist in DB
        if (Skema::where('skema_label', $name)->where('skema_id', '!=', $id)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Nama skema Sudah Ada' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'skema_label' => $name,
        ];

        //Update Data
        Skema::where('skema_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'skema Diubah' //Sub Alert Message
        );

        return redirect()->route('admin_skema');
    }

    public function destroy($id)
    {
        Skema::destroy('skema_id', $id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'skema Terhapus' //Sub Alert Message
        );

        return redirect()->route('admin_skema');
    }
}
