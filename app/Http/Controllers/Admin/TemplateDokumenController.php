<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Models\Skema;

class TemplateDokumenController extends Controller
{
    // Template Dokumen
    public function index()
    {
        $template = get_local_db_json('template_dokumen.json');

        $view_data = [
            'template' => $template,
        ];

        return view('admin.template_dokumen.index', $view_data);
    }

    public function edit($id)
    {
        $template = get_where_local_db_json("template_dokumen.json", "id", $id);

        $view_data = [
            'template' => $template,
            'id' => $id,
        ];

        return view('admin.template_dokumen.edit', $view_data);
    }

    public function update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'template' => 'required|mimes:pdf,doc,docx,xls,xlsx|max:10000'
            ],
            [
                'template.mimes' => 'Tipe File Harus PDF, DOC, DOCX, XLS, XLSX'
            ]
        );

        $file = $request->file('template');
        $destination = "assets/file/template_dokumen/";
        $original_name = $file->getClientOriginalName();
        $hash_name = $file->hashName();
        $base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $size = intval($file->getSize() / 1024);
        $extension = $file->getClientOriginalExtension();

        $old_data = get_where_local_db_json("template_dokumen.json", "id", $id);

        if ($old_data["hash_name"] != "" || $old_data["hash_name"] != NULL) {
            $file_path = public_path($destination . $old_data["hash_name"]);

            $file->move($destination, $file->hashName());

            File::delete($file_path);

            $data = [
                "id" => $id,
                "name" => $request->name,
                "target" => $request->target,
                "original_name" => $original_name,
                "hash_name" => $hash_name,
                "base_name" => $base_name,
                "extension" => $extension,
                "size" => $size,
                "datetime" => date('Y-m-d H:i:s'),
            ];

            update_local_db_json("template_dokumen.json", "id", $id, $data);
        } else {
            $file->move($destination, $file->hashName());

            $data = [
                "id" => $id,
                "name" => $request->name,
                "target" => $request->target,
                "original_name" => $original_name,
                "hash_name" => $hash_name,
                "base_name" => $base_name,
                "extension" => $extension,
                "size" => $size,
                "datetime" => date('Y-m-d H:i:s'),
            ];

            update_local_db_json("template_dokumen.json", "id", $id, $data);
        }

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Template Update' //Sub Alert Message
        );

        return redirect()->route('admin_template_dokumen');
    }

    public function destroy(Request $request, $id)
    {
        $destination = "assets/file/template_dokumen/";

        $old_data = get_where_local_db_json("template_dokumen.json", "id", $id);

        if ($old_data["hash_name"] != "" || $old_data["hash_name"] != NULL) {
            $file_path = public_path($destination . $old_data["hash_name"]);

            File::delete($file_path);

            $data = [
                "id" => $id,
                "name" => $request->name,
                "target" => $request->target,
                "original_name" => "",
                "hash_name" => "",
                "base_name" => "",
                "extension" => "",
                "size" => "",
                "datetime" => "",
            ];

            update_local_db_json("template_dokumen.json", "id", $id, $data);

            //Flash Message
            flash_alert(
                __('alert.icon_success'), //Icon
                'Sukses', //Alert Message 
                'Template Dihapus' //Sub Alert Message
            );
        }

        return redirect()->route('admin_template_dokumen');
    }
}
