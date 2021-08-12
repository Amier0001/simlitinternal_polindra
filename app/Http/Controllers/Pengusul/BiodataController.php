<?php

namespace App\Http\Controllers\Pengusul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Models\User;
use App\Models\Biodata;
use App\Models\Jurusan;
use App\Models\Prodi;

class BiodataController extends Controller
{
    public function edit()
    {
        $id = Session::get('user_id');
        $user = User::find($id);

        $jurusan = Jurusan::orderBy('jurusan_nama', 'asc')->get();
        $prodi = Prodi::orderBy('prodi_nama', 'asc')->get();

        return view('pengusul.biodata.biodata_edit', ['user' => $user, 'user_id' => $id, 'jurusan' => $jurusan, 'prodi' => $prodi]);
    }

    public function update(Request $request)
    {
        $id = Session::get('user_id');

        // Input Validation
        $request->validate([
            'nama'  => 'required|max:255',
            'sex'  => 'required',
            'institusi'  => 'required|max:255',
            'jurusan'  => 'required|max:255',
            'program_studi'  => 'required|max:255',
            'pendidikan'  => 'required|max:255',
            'jabatan'  => 'required|max:255',
            'alamat'  => 'required|max:255',
            'tempat_lahir'  => 'required|max:255',
            'tanggal_lahir'  => 'required',
            'no_ktp'  => 'required|max:16',
            'no_telp'  => 'max:16',
            'no_hp'  => 'max:16',
            'email'  => 'required|email:rfc,dns|max:255',
            'web'  => 'max:255',
            'schoolar_id'  => 'max:255',
            'scopus_id'  => 'max:255',
        ]);

        //check is Email exist in DB
        if (User::where('user_email', htmlspecialchars($request->email))->where('user_id', '!=', $id)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Email Sudah Terdaftar' //Sub Alert Message
            );

            return redirect()->back();
        }

        //Update Data
        $data_user = [
            'user_email' => htmlspecialchars($request->email),
            'user_name' => htmlspecialchars($request->nama),
        ];
        User::where('user_id', $id)
            ->update($data_user);

        $data_biodata = [
            'biodata_user_id' => $id,
            'biodata_sex' => htmlspecialchars($request->sex),
            'biodata_institusi' => htmlspecialchars($request->institusi),
            'biodata_jurusan' => htmlspecialchars($request->jurusan),
            'biodata_program_studi' => htmlspecialchars($request->program_studi),
            'biodata_jabatan' => htmlspecialchars($request->jabatan),
            'biodata_pendidikan' => htmlspecialchars($request->pendidikan),
            'biodata_alamat' => htmlspecialchars($request->alamat),
            'biodata_tempat_lahir' => htmlspecialchars($request->tempat_lahir),
            'biodata_tanggal_lahir' => htmlspecialchars($request->tanggal_lahir),
            'biodata_no_ktp' => htmlspecialchars($request->no_ktp),
            'biodata_no_hp' => htmlspecialchars($request->no_hp),
            'biodata_no_telp' => htmlspecialchars($request->no_telp),
            'biodata_web_personal' => htmlspecialchars($request->web),
            'biodata_scopus_id' => htmlspecialchars($request->scopus_id),
            'biodata_google_schoolar_id' => htmlspecialchars($request->schoolar_id),
        ];

        Biodata::updateOrInsert(
            ['biodata_user_id' => $id],
            $data_biodata
        );

        //Update Session
        $session = [
            'user_name' => htmlspecialchars($request->nama),
            'user_email' => htmlspecialchars($request->email),
        ];
        $request->session()->put($session);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Biodata Diperbaharui' //Sub Alert Message
        );

        return redirect()->route('pengusul_dashboard');
    }

    public function update_picture(Request $request)
    {
        $id = Session::get('user_id');

        // Input Validation
        $request->validate([
            'image'  => 'required|mimetypes:image/png,image/jpeg,image/gif',
        ], [
            'image.mimetypes' => "The image must be a file of type: png, jpeg, jpg, gif."
        ]);

        $file = $request->file('image');
        $destination = "assets/img/profile/";

        $imageOld =  User::where('user_id', $id)->first();
        $image_path = public_path($destination . $imageOld->user_image);

        //Update Data
        $data = [
            'user_image' => $file->hashName(),
        ];
        User::where('user_id', $id)
            ->update($data);

        //Update Session
        $session = [
            'user_image' => $file->hashName(),
        ];
        $request->session()->put($session);

        $file->move($destination, $file->hashName());

        if ($imageOld->user_image != "default.jpg") {
            File::delete($image_path);
        }

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Foto Diperbaharui' //Sub Alert Message
        );

        return redirect()->back();
    }
}
