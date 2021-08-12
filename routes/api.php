<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => '{api_code}'], function () {
    Route::group(['middleware' => ['is_Api_Code']], function () {
        Route::group(['prefix' => 'auth'], function () {
            // Route::get('/get/login', 'API\AuthController@get_login');
            Route::post('/post/login', 'API\AuthController@post_login')->name('api_post_login');
            // Route::get('/{id}/show', 'API\ApiController@show');
            // Route::get('/create', 'API\ApiController@create');
            // Route::get('/{id}/edit', 'API\ApiController@edit');
            // Route::put('/{id}/update', 'API\ApiController@update');
            // Route::delete('/{id}/destroy', 'API\ApiController@destroy');
        });

        Route::group(['prefix' => 'penelitian'], function () {
        });

        Route::group(['prefix' => 'logbook'], function () {
        });

         Route::group(['prefix' => 'user'], function () {
        });

        Route::group(['prefix' => 'unlock'], function () {
        });

        Route::group(['prefix' => 'laporan_kemajuan'], function () {
        });

        Route::group(['prefix' => 'laporan_akhir'], function () {
        });
    });
});