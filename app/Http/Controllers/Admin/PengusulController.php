<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use App\Models\User;
use App\Models\Biodata;
use App\Models\Jurusan;
use App\Models\Prodi;

class PengusulController extends Controller
{
    public function index()
    {
        $user = User::where('user_role', '=', 'pengusul')
            ->where('user_id', '!=', Session::get('user_id'))
            ->orderBy('user_name', 'asc')->get();

        return view('admin.pengusul.index', ['user' => $user]);
    }

    public function insert()
    {
        $jurusan = Jurusan::orderBy('jurusan_nama', 'asc')->get();
        $prodi = Prodi::orderBy('prodi_nama', 'asc')->get();

        $view_data = [
            'jurusan' => $jurusan,
            'prodi' => $prodi,
        ];

        return view('admin.pengusul.insert', $view_data);
    }

    public function store(Request $request)
    {
        // Input Validation
        $request->validate([
            'nidn'  => 'required|max:10',
            'name'  => 'required|max:255',
            'email'  => 'required|max:255',
            'password'  => 'required|max:100|min:8',
            'sex'  => 'required',
            'institusi'  => 'max:255',
            'jurusan'  => 'max:255',
            'program_studi'  => 'max:255',
            'pendidikan'  => 'max:255',
            'jabatan'  => 'max:255',
        ]);

        $id = hexdec(uniqid()) . strtotime(now());
        $nidn = htmlspecialchars($request->nidn);
        $name = htmlspecialchars($request->name);
        $email = htmlspecialchars($request->email);
        $password = htmlspecialchars($request->password);
        $image = "default.jpg";

        //check is email exist in DB
        if (User::where('user_email', $email)->where('user_role', 'pengusul')->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Email Sudah Terdaftar' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'user_id' => $id,
            'user_password' => Hash::make($password),
            'user_name' => $name,
            'user_nidn' => $nidn,
            'user_email' => $email,
            'user_role' => 'pengusul',
            'user_image' => $image,
        ];

        //Insert Data
        User::create($data);

        $data_biodata = [
            'biodata_user_id' => $id,
            'biodata_sex' => htmlspecialchars($request->sex),
            'biodata_institusi' => htmlspecialchars($request->institusi),
            'biodata_jurusan' => htmlspecialchars($request->jurusan),
            'biodata_program_studi' => htmlspecialchars($request->program_studi),
            'biodata_jabatan' => htmlspecialchars($request->jabatan),
            'biodata_pendidikan' => htmlspecialchars($request->pendidikan),
        ];

        Biodata::create($data_biodata);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Pengusul Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('admin_pengusul');
    }

    public function edit($id)
    {
        $user = User::join('biodata', 'biodata_user_id', '=', 'user_id')
            ->where('user_id', $id)->first();

        $jurusan = Jurusan::orderBy('jurusan_nama', 'asc')->get();
        $prodi = Prodi::orderBy('prodi_nama', 'asc')->get();

        $view_data = [
            'user' => $user,
            'jurusan' => $jurusan,
            'prodi' => $prodi,
        ];

        return view('admin.pengusul.edit', $view_data);
    }

    public function update(Request $request, $id)
    {
        // Input Validation
        if (htmlspecialchars($request->password) != NULL) {
            $request->validate([
                'nidn'  => 'required|max:16',
                'name'  => 'required|max:255',
                'email'  => 'required|max:255',
                'password'  => 'max:100|min:8',
                'sex'  => 'required',
                'institusi'  => 'max:255',
                'jurusan'  => 'max:255',
                'program_studi'  => 'max:255',
                'pendidikan'  => 'max:255',
                'jabatan'  => 'max:255',
            ]);
        } else {
            $request->validate([
                'name'  => 'required|max:255',
                'email'  => 'required|max:255',
                'nidn'  => 'required|max:16',
                'sex'  => 'required',
                'institusi'  => 'max:255',
                'jurusan'  => 'max:255',
                'program_studi'  => 'max:255',
                'pendidikan'  => 'max:255',
                'jabatan'  => 'max:255',
            ]);
        }

        $user = User::where('user_id', $id)->first();

        $nidn = htmlspecialchars($request->nidn);
        $name = htmlspecialchars($request->name);
        $email = htmlspecialchars($request->email);
        $password = (htmlspecialchars($request->password) != NULL) ? Hash::make($request->password) : $user->user_password;
        // $active = ($request->active == 'on') ? true : false;
        // $suspend = ($request->suspend == 'on') ? true : false;

        //check is Email exist in DB
        if (User::where('user_email', $email)->where('user_role', 'pengusul')->where('user_id', '!=', $user->user_id)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Email Sudah Terdaftar' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'user_nidn' => $nidn,
            'user_password' => $password,
            'user_name' => $name,
            'user_email' => $email,
            // 'user_active' => $active,
            // 'user_ban' => $suspend,
        ];

        //Update Data
        User::where('user_id', $id)
            ->update($data);

        $data_biodata = [
            'biodata_sex' => htmlspecialchars($request->sex),
            'biodata_institusi' => htmlspecialchars($request->institusi),
            'biodata_jurusan' => htmlspecialchars($request->jurusan),
            'biodata_program_studi' => htmlspecialchars($request->program_studi),
            'biodata_jabatan' => htmlspecialchars($request->jabatan),
            'biodata_pendidikan' => htmlspecialchars($request->pendidikan),
        ];

        // Update Data
        Biodata::where('biodata_user_id', $id)->update($data_biodata);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Pengusul Diperbaharui' //Sub Alert Message
        );

        return redirect()->route('admin_pengusul');
    }

    public function destroy($id)
    {
        $destination = "assets/img/profile/";

        $imageOld =  User::where('user_id', $id)->first();
        $image_path = public_path($destination . $imageOld->user_image);

        User::destroy('user_id', $id);

        if ($imageOld->user_image != "default.jpg") {
            File::delete($image_path);
        }

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Pengusul Terhapus' //Sub Alert Message
        );

        return redirect()->route('admin_pengusul');
    }
    public function suspend(Request $request, $id)
    {
        $user = User::where('user_id', $id)->first();

        $suspend = ($user->user_ban == false) ? true : false;

        $data = [
            'user_ban' => $suspend,
        ];

        //Update Data
        User::where('user_id', $id)
            ->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Status Pengusul Diperbaharui' //Sub Alert Message
        );

        return redirect()->route('admin_pengusul');
    }
}
