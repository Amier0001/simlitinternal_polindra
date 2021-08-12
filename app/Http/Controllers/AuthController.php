<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Rules\Captcha;

use App\Models\User;
use App\Models\Forgot_token;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_process(Request $request)
    {
        //Validation Form
        $request->validate(
            [
                'login_email'  => 'required|email:rfc,dns|max:255',
                'login_password'  => 'required|max:100|min:8',
                'g-recaptcha-response' => new Captcha(),
            ],
            [
                'login_password.required' => 'The password field is required.',
                'login_email.required' => 'The email field is required.',
                'login_email.email' => 'The email field is wrong format.'
            ]
        );

        $email = htmlspecialchars($request->login_email);
        $password = htmlspecialchars($request->login_password);

        $user = User::firstWhere('user_email', $email);

        //Check Email Account Available
        if ($user) {
            //Check Email Match
            if ($email == $user->user_email) {
                //Check Password Match
                if (Hash::check($password, $user->user_password)) {
                    //Create Session
                    $data = [
                        'user_id' => $user->user_id,
                        'user_name' => $user->user_name,
                        'user_email' => $user->user_email,
                        'user_role' => $user->user_role,
                        'user_image' => $user->user_image
                    ];
                    $request->session()->put($data);

                    // Check Redirect Page
                    if ($user->user_role == "admin") {
                        //Goto Admin Dashborad
                        return redirect()->route('admin_dashboard');
                    } else if ($user->user_role == "reviewer") {
                        //Goto Reviewer Dashborad
                        return redirect()->route('reviewer_dashboard');
                    } else if ($user->user_role == "pengusul") {
                        //Goto Pengusul Dashborad
                        return redirect()->route('pengusul_dashboard');
                    }
                } else {
                    //Flash Message
                    flash_alert(
                        __('alert.icon_error'), //Icon
                        'Login Gagal', //Alert Message 
                        'Password Salah' //Sub Alert Message
                    );

                    return redirect()->back();
                }
            } else {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Login Gagal', //Alert Message 
                    // 'Akun Tidak Aktif' //Sub Alert Message
                    'Email Salah' //Sub Alert Message
                );

                return redirect()->back();
            }
        } else {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Login Gagal', //Alert Message 
                'Akun Tidak Terdaftar' //Sub Alert Message
            );

            return redirect()->back();
        }

        //If Bug Not Through Filtering Process Above
        //Flash Message
        flash_alert(
            __('alert.icon_error'), //Icon
            'Login Gagal', //Alert Message 
            'Ada Sesuatu Yang Salah' //Sub Alert Message
        );

        return redirect()->back();
    }

    public function logout()
    {
        //Clean Session
        Session::flush();

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Logout Sukses', //Alert Message 
            'Silahkan Login Kembali Untuk Menggunakan Aplikasi' //Sub Alert Message
        );

        //Back To Login
        return redirect()->route('login');
    }

    public function forgot_password()
    {
        return view('auth.forgot_password');
    }

    public function forgot_password_process(Request $request)
    {
        //Validation Form
        $request->validate(
            [
                'email'  => 'required|email:rfc,dns|max:255',
                'g-recaptcha-response' => new Captcha(),
            ],
            [
                'email.required' => 'The email field is required.',
                'email.email' => 'The email field is wrong format.'
            ]
        );

        $email = htmlspecialchars($request->email);

        $user = User::where('user_email', $email)->first();

        // Check is email exist
        if (!$user) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Email Tidak Ditemukan' //Sub Alert Message
            );

            return redirect()->back();
        }

        $token = Str::uuid();
        $data = $user->toArray();
        $data["token"] = ['token' => $token];

        //Send Email
        Mail::send(
            'email.forgot_password',
            $data,
            function ($message) use ($user) {
                $message->to($user->user_email, $user->user_name)
                    ->subject('Lupa Password');
            }
        );

        Forgot_token::create([
            'forgot_token_user_id' => $user->user_id,
            'forgot_token_user_email' => $user->user_email,
            'forgot_token' => $token,
            'forgot_token_due_time' => strtotime(date('Y-m-d H:i:s')) + 3600 * 24,
        ]);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Email Terkirim', //Alert Message 
            'Silahkan Cek Email Anda Untuk Konfirmasi' //Sub Alert Message
        );

        return redirect()->back();
    }

    public function change_password($email, $token)
    {
        // Check Token 
        $row = Forgot_token::where('forgot_token_user_email', $email)->where('forgot_token', $token)->first();
        if (!$row) {
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Email atau Token Tidak Ditemukan' //Sub Alert Message
            );

            return redirect()->route('forgot_password');
        }

        // Check Token Expired
        if (strtotime(date('Y-m-d H:i:s')) > intval($row->forgot_token_due_time)) {

            Forgot_token::where('forgot_token_user_email', $email)->delete();

            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Token Kadaluwarsa' //Sub Alert Message
            );

            return redirect()->route('forgot_password');
        }

        return view('auth.change_password', ['token' => $token, 'email' => $email]);
    }

    public function change_password_process(Request $request, $email, $token)
    {
        //Check Token 
        $row = Forgot_token::where('forgot_token_user_email', $email)->where('forgot_token', $token)->first();
        if (!$row) {
            flash_alert(
                __('alert.icon_error'), //Icon
                'gagal', //Alert Message 
                'Email Atau Token Tidak Ditemukan' //Sub Alert Message
            );

            return redirect()->route('forgot_password');
        }

        // Check Token Expired
        if (strtotime(date('Y-m-d H:i:s')) > intval($row->forgot_token_due_time)) {

            Forgot_token::where('forgot_token_user_email', $email)->delete();

            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Token Kadaluwarsa' //Sub Alert Message
            );

            return redirect()->route('forgot_password');
        }

        //Validation Form
        $request->validate(
            [
                'new_password'  => 'required|max:100',
                'retype_password'  => 'required|max:100|same:new_password',
            ]
        );

        $password = htmlspecialchars($request->new_password);

        User::where('user_email', $email)->update(['user_password' => Hash::make($password)]);

        Forgot_token::where('forgot_token_user_email', $email)->delete();

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Password Diperbaharui' //Sub Alert Message
        );

        return redirect()->route('login');
    }
}
