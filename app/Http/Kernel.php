<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'is_Login' => \App\Http\Middleware\Is_Login::class,
        'is_Not_Login' => \App\Http\Middleware\Is_Not_Login::class,
        'is_Admin' => \App\Http\Middleware\Is_Admin::class,
        'is_Pengusul' => \App\Http\Middleware\Is_Pengusul::class,
        'is_Reviewer' => \App\Http\Middleware\Is_Reviewer::class,
        'prevent_Back_Button' => \App\Http\Middleware\Prevent_Back_Button::class,
        'is_Unlock_Tambah_Usulan' => \App\Http\Middleware\Is_Unlock_Tambah_Usulan::class,
        'is_Unlock_Tambah_Logbook' => \App\Http\Middleware\Is_Unlock_Tambah_Logbook::class,
        'is_Unlock_Tambah_Laporan_Akhir' => \App\Http\Middleware\Is_Unlock_Tambah_Laporan_Akhir::class,
        'is_Unlock_Tambah_Laporan_Kemajuan' => \App\Http\Middleware\Is_Unlock_Tambah_Laporan_Kemajuan::class,
        'is_Unlock_Nilai_Usulan' => \App\Http\Middleware\Is_Unlock_Nilai_Usulan::class,
        'is_Unlock_Monev_Penelitian' => \App\Http\Middleware\Is_Unlock_Monev_Penelitian::class,
        'is_Unlock_Pass' => \App\Http\Middleware\Is_Unlock_Pass::class,
        'is_Suspend' => \App\Http\Middleware\Is_Suspend::class,
        'is_Diterima' => \App\Http\Middleware\Is_Diterima::class,
        'is_Not_Pending' => \App\Http\Middleware\Is_Not_Pending::class,
        'is_Owner' => \App\Http\Middleware\Is_Owner::class,
        'is_Api_Code' => \App\Http\Middleware\Is_Api_Code::class,
    ];
}
