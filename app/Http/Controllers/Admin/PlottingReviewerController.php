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
use App\Models\Usulan_penelitian;

class PlottingReviewerController extends Controller
{
    public function index()
    {
        $user = User::where('user_role', '=', 'reviewer')
            ->where('user_id', '!=', Session::get('user_id'))
            ->orderBy('user_name', 'asc')->get();

        $usulan_penelitian = Usulan_penelitian::leftjoin('users', 'usulan_penelitian.usulan_penelitian_reviewer_id', '=', 'users.user_id')
            ->where('usulan_penelitian_submit', true)
            ->where('usulan_penelitian_status', '!=', 'pending')
            ->orderBy('usulan_penelitian.updated_at', 'desc')
            ->orderBy('usulan_penelitian_tahun', 'asc')
            ->get();

        $view_data = [
            'user' => $user,
            'usulan_penelitian' => $usulan_penelitian,
        ];

        return view('admin.plotting_reviewer.index', $view_data);
    }

    public function give_reviewer($id)
    {
        $reviewer = User::where('user_role', 'reviewer')->get();

        $view_data = [
            'usulan_id' => $id,
            'reviewer' => $reviewer,
        ];

        return view('admin.plotting_reviewer.give', $view_data);
    }

    public function give_reviewer_update(Request $request, $id)
    {
        // Input Validation
        $request->validate([
            'reviewer'  => 'required',
        ]);

        $reviewer = htmlspecialchars($request->reviewer);

        $data = [
            'usulan_penelitian_reviewer_id' => $reviewer,
        ];

         //Update Data
        Usulan_penelitian::where('usulan_penelitian_id', $id)
            ->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Reviewer Diplotting' //Sub Alert Message
        );

        return redirect()->route('admin_plotting_reviewer');
    }

    // MONEV
    public function index_monev()
    {
        $user = User::where('user_role', '=', 'reviewer')
            ->where('user_id', '!=', Session::get('user_id'))
            ->orderBy('user_name', 'asc')->get();

        $usulan_penelitian = Usulan_penelitian::leftjoin('users', 'usulan_penelitian.usulan_penelitian_reviewer_monev_id', '=', 'users.user_id')
            ->where('usulan_penelitian_submit', true)
            ->where('usulan_penelitian_status', '=', 'diterima')
            ->orderBy('usulan_penelitian.updated_at', 'desc')
            ->orderBy('usulan_penelitian_tahun', 'asc')
            ->get();

        $view_data = [
            'user' => $user,
            'usulan_penelitian' => $usulan_penelitian,
        ];


        return view('admin.plotting_reviewer.index_monev', $view_data);
    }

    public function give_monev_reviewer($id)
    {
        $reviewer = User::where('user_role', 'reviewer')->get();

        $view_data = [
            'usulan_id' => $id,
            'reviewer' => $reviewer,
        ];

        return view('admin.plotting_reviewer.give_monev', $view_data);
    }

    public function give_monev_reviewer_update(Request $request, $id)
    {
        // Input Validation
        $request->validate([
            'reviewer'  => 'required',
        ]);

        $reviewer = htmlspecialchars($request->reviewer);

        $data = [
            'usulan_penelitian_reviewer_monev_id' => $reviewer,
        ];

        //Update Data
        Usulan_penelitian::where('usulan_penelitian_id', $id)
            ->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Reviewer Diplotting' //Sub Alert Message
        );

        return redirect()->route('admin_plotting_monev_reviewer');
    }

    // ==================(ARCHIVE)=======================
    // public function insert()
    // {
    //     $user = User::orderBy('user_name', 'asc')->get();

    //     return view('admin.reviewer.insert', ['user' => $user]);
    // }

    // public function store(Request $request)
    // {
    //     // Input Validation
    //     $request->validate([
    //         'nidn'  => 'required|max:255',
    //         'name'  => 'required|max:255',
    //         'email'  => 'required|max:255',
    //         'password'  => 'required|max:100|min:8',
    //     ]);

    //     $id = str_replace('-', '', Str::uuid());
    //     $nidn = htmlspecialchars($request->nidn);
    //     $name = htmlspecialchars($request->name);
    //     $email = htmlspecialchars($request->email);
    //     $password = htmlspecialchars($request->password);
    //     $image = "default.jpg";

    //     //check is email exist in DB
    //     if (User::where('user_email', $email)->where('user_role', 'reviewer')->count() > 0) {
    //         //Flash Message
    //         flash_alert(
    //             __('alert.icon_error'), //Icon
    //             'Gagal', //Alert Message 
    //             'Email Sudah Terdaftar' //Sub Alert Message
    //         );


    //         return redirect()->back();
    //     }

    //     $data = [
    //         'user_id' => $id,
    //         'user_password' => Hash::make($password),
    //         'user_nidn' => $nidn,
    //         'user_name' => $name,
    //         'user_email' => $email,
    //         'user_role' => 'reviewer',
    //         'user_image' => $image,
    //     ];

    //     //Insert Data
    //     $query = User::create($data);

    //     $data_biodata = [
    //         'biodata_user_id' => $query->user_id
    //     ];

    //     Biodata::create($data_biodata);

    //     //Flash Message
    //     flash_alert(
    //         __('alert.icon_success'), //Icon
    //         'Sukses', //Alert Message 
    //         'Reviewer Ditambahkan' //Sub Alert Message
    //     );


    //     return redirect()->route('admin_reviewer');
    // }

    // public function destroy($id)
    // {
    //     $destination = "assets/img/profile/";

    //     $imageOld =  User::where('user_id', $id)->first();
    //     $image_path = public_path($destination . $imageOld->user_image);

    //     User::destroy('user_id', $id);

    //     if ($imageOld->user_image != "default.jpg") {
    //         File::delete($image_path);
    //     }

    //     //Flash Message
    //     flash_alert(
    //         __('alert.icon_success'), //Icon
    //         'Sukses', //Alert Message 
    //         'Reviewer Terhapus' //Sub Alert Message
    //     );

    //     return redirect()->route('admin_reviewer');
    // }
}
