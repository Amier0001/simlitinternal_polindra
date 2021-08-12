<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/second', function () {
    echo "Routing Second Test";
});

//Logout
Route::get('/logout', 'AuthController@logout')->name('logout');

//AUTH PAGE (NOT LOGIN REQUIRED)
Route::group(['middleware' => ['prevent_Back_Button']], function () {
    Route::group(['middleware' => ['is_Not_Login']], function () {
        //Root Link -> Linked To Login
        Route::get('/', 'AuthController@login');

        //Login
        Route::get('/login', 'AuthController@login')->name('login');
        Route::post('/login', 'AuthController@login_process')->name('login_process');

        //Forgot Password
        Route::get('/forgot', 'AuthController@forgot_password')->name('forgot_password');
        Route::post('/forgot', 'AuthController@forgot_password_process')->name('forgot_password_process');

        //Change To New Password (Forgot Password)
        Route::get('/{email}/{token}/change', 'AuthController@change_password')->name('change_password');
        Route::post('/{email}/{token}/change', 'AuthController@change_password_process')->name('change_password_process');
    });
});

//USER PAGE (LOGIN REQUIRED)
Route::group(['middleware' => ['prevent_Back_Button']], function () {
    Route::group(['middleware' => ['is_Login']], function () {

        //ADMIN
        Route::group(['middleware' => ['is_Admin']], function () {
            Route::group(['prefix' => 'admin'], function () {
                //Dashboard
                Route::group(['prefix' => '/dashboard'], function () {
                    Route::get('/', 'Admin\DashboardController@index')->name('admin_dashboard');
                });

                //Penelitian
                Route::group(['prefix' => 'penelitian'], function () {
                    Route::group(['prefix' => 'usulan'], function () {
                        Route::get('/', 'Admin\PenelitianController@usulan_penelitian')->name('admin_penelitian_usulan');
                        Route::get('/riwayat', 'Admin\PenelitianController@riwayat')->name('admin_penelitian_riwayat');
                        Route::get('/{jurusan_id}/jurusan', 'Admin\PenelitianController@usulan_penelitian_jurusan')->name('admin_penelitian_usulan_jurusan');
                        Route::get('/riwayat/{jurusan_id}/jurusan', 'Admin\PenelitianController@riwayat_jurusan')->name('admin_penelitian_riwayat_jurusan');
                        Route::get('/{id}/unlock', 'Admin\PenelitianController@unlock')->name('admin_penelitian_unlock');
                        Route::patch('/{id}/unlock', 'Admin\PenelitianController@unlock_update')->name('admin_penelitian_unlock_update');
                        Route::get('/detail/{id}/view/{back_param}', 'Admin\PenelitianController@detail')->name('admin_penelitian_detail');
                        Route::get('/{id}/konfirmasi', 'Admin\PenelitianController@konfirmasi')->name('admin_penelitian_usulan_konfirmasi');
                        Route::patch('/{id}/konfirmasi', 'Admin\PenelitianController@konfirmasi_update')->name('admin_penelitian_usulan_konfirmasi_update');
                    });

                    Route::group(['prefix' => 'pelaksanaan'], function () {
                        Route::get('/', 'Admin\PenelitianController@pelaksanaan_penelitian')->name('admin_penelitian_pelaksanaan');
                        Route::patch('/', 'Admin\PenelitianController@pelaksanaan_penelitian_update')->name('admin_penelitian_pelaksanaan_update');

                        Route::group(['prefix' => 'penilaian'], function () {
                            Route::get('/', 'Admin\PenelitianController@pelaksanaan_penilaian')->name('admin_penilaian_pelaksanaan');
                            Route::patch('/', 'Admin\PenelitianController@pelaksanaan_penilaian_update')->name('admin_penilaian_pelaksanaan_update');
                        });
                    });

                    // Route::get('/detail', 'Admin\PenelitianController@detail')->name('admin_penelitian_detail');
                });

                //Penilaian
                //Skema Penelitian
                Route::group(['prefix' => 'skema'], function () {
                    Route::get('/', 'Admin\SkemaController@index')->name('admin_skema');
                    Route::get('/insert', 'Admin\SkemaController@insert')->name('admin_skema_insert');
                    Route::post('/store', 'Admin\SkemaController@store')->name('admin_skema_store');
                    Route::get('/{id}/edit', 'Admin\SkemaController@edit')->name('admin_skema_edit');
                    Route::patch('/{id}/update', 'Admin\SkemaController@update')->name('admin_skema_update');
                    Route::delete('/{id}/destroy', 'Admin\SkemaController@destroy')->name('admin_skema_destroy');
                });
                //Bidang Penelitian
                Route::group(['prefix' => 'bidang'], function () {
                    Route::get('/', 'Admin\BidangController@index')->name('admin_bidang');
                    Route::get('/insert', 'Admin\BidangController@insert')->name('admin_bidang_insert');
                    Route::post('/store', 'Admin\BidangController@store')->name('admin_bidang_store');
                    Route::get('/{id}/edit', 'Admin\BidangController@edit')->name('admin_bidang_edit');
                    Route::patch('/{id}/update', 'Admin\BidangController@update')->name('admin_bidang_update');
                    Route::delete('/{id}/destroy', 'Admin\BidangController@destroy')->name('admin_bidang_destroy');
                });

                //Jurusan
                Route::group(['prefix' => 'jurusan'], function () {
                    Route::get('/', 'Admin\JurusanController@index')->name('admin_jurusan');
                    Route::get('/insert', 'Admin\JurusanController@insert')->name('admin_jurusan_insert');
                    Route::post('/store', 'Admin\JurusanController@store')->name('admin_jurusan_store');
                    Route::get('/{id}/edit', 'Admin\JurusanController@edit')->name('admin_jurusan_edit');
                    Route::patch('/{id}/update', 'Admin\JurusanController@update')->name('admin_jurusan_update');
                    Route::delete('/{id}/destroy', 'Admin\JurusanController@destroy')->name('admin_jurusan_destroy');

                    // Program Studi
                    Route::group(['prefix' => '/{jurusan_id}/prodi'], function () {
                        Route::get('/', 'Admin\JurusanController@prodi_index')->name('admin_prodi');
                        Route::get('/insert', 'Admin\JurusanController@prodi_insert')->name('admin_prodi_insert');
                        Route::post('/store', 'Admin\JurusanController@prodi_store')->name('admin_prodi_store');
                        Route::get('/{id}/edit', 'Admin\JurusanController@prodi_edit')->name('admin_prodi_edit');
                        Route::patch('/{id}/update', 'Admin\JurusanController@prodi_update')->name('admin_prodi_update');
                        Route::delete('/{id}/destroy', 'Admin\JurusanController@prodi_destroy')->name('admin_prodi_destroy');
                    });
                });

                //Data Pendukung
                Route::group(['prefix' => 'data_pendukung'], function () {
                    Route::get('/', 'Admin\DataPendukungController@index')->name('admin_data_pendukung');
                });

                //Data Luaran
                Route::group(['prefix' => 'data_luaran'], function () {
                    Route::get('/', 'Admin\DataLuaranController@index')->name('admin_data_luaran');

                    // Kategori
                    Route::get('/kategori/insert', 'Admin\DataLuaranController@kategori_insert')->name('admin_data_luaran_kategori_insert');
                    Route::post('/kategori/insert', 'Admin\DataLuaranController@kategori_store')->name('admin_data_luaran_kategori_store');
                    Route::get('/kategori/{id}/edit', 'Admin\DataLuaranController@kategori_edit')->name('admin_data_luaran_kategori_edit');
                    Route::patch('/kategori/{id}/edit', 'Admin\DataLuaranController@kategori_update')->name('admin_data_luaran_kategori_update');
                    Route::delete('/kategori/{id}/destroy', 'Admin\DataLuaranController@kategori_destroy')->name('admin_data_luaran_kategori_destroy');

                    // Jenis
                    Route::get('/jenis/insert', 'Admin\DataLuaranController@jenis_insert')->name('admin_data_luaran_jenis_insert');
                    Route::post('/jenis/insert', 'Admin\DataLuaranController@jenis_store')->name('admin_data_luaran_jenis_store');
                    Route::get('/jenis/{id}/edit', 'Admin\DataLuaranController@jenis_edit')->name('admin_data_luaran_jenis_edit');
                    Route::patch('/jenis/{id}/edit', 'Admin\DataLuaranController@jenis_update')->name('admin_data_luaran_jenis_update');
                    Route::delete('/jenis/{id}/destroy', 'Admin\DataLuaranController@jenis_destroy')->name('admin_data_luaran_jenis_destroy');

                    // Status
                    Route::get('/status/insert', 'Admin\DataLuaranController@status_insert')->name('admin_data_luaran_status_insert');
                    Route::post('/status/insert', 'Admin\DataLuaranController@status_store')->name('admin_data_luaran_status_store');
                    Route::get('/status/{id}/edit', 'Admin\DataLuaranController@status_edit')->name('admin_data_luaran_status_edit');
                    Route::patch('/status/{id}/edit', 'Admin\DataLuaranController@status_update')->name('admin_data_luaran_status_update');
                    Route::delete('/status/{id}/destroy', 'Admin\DataLuaranController@status_destroy')->name('admin_data_luaran_status_destroy');
                });

                //Logbook
                Route::group(['prefix' => 'logbook'], function () {
                    Route::get('/', 'Admin\LogbookController@index')->name('admin_logbook');
                    // Route::get('/detail', 'Admin\LogbookController@detail')->name('admin_logbook_detail');
                    Route::get('/{penelitian_id}/detail', 'Admin\LogbookController@logbook_index')->name('admin_logbook_detail');
                     Route::get('/{penelitian_id}/detail/{id}/uraian', 'Admin\LogbookController@logbook_uraian')->name('admin_logbook_detail_uraian');
                });

                //Laporan Kemajuan
                Route::group(['prefix' => 'laporan_kemajuan'], function () {
                    Route::get('/', 'Admin\LaporanKemajuanController@index')->name('admin_laporan_kemajuan');
                    Route::get('/{penelitian_id}/list', 'Admin\LaporanKemajuanController@list')->name('admin_laporan_kemajuan_list');
                });

                //Laporan Akhir
                Route::group(['prefix' => 'laporan_akhir'], function () {
                    Route::get('/', 'Admin\LaporanAkhirController@index')->name('admin_laporan_akhir');
                });

                //Reviewer & Ploting Reviewer
                Route::group(['prefix' => 'reviewer'], function () {
                    Route::group(['prefix' => 'daftar'], function () {
                        Route::get('/', 'Admin\ReviewerController@index')->name('admin_reviewer');
                        Route::get('/insert', 'Admin\ReviewerController@insert')->name('admin_reviewer_insert');
                        Route::post('/store', 'Admin\ReviewerController@store')->name('admin_reviewer_store');
                        Route::get('/edit/{id}', 'Admin\ReviewerController@edit')->name('admin_reviewer_edit');
                        Route::patch('/edit/{id}', 'Admin\ReviewerController@update')->name('admin_reviewer_update');
                        Route::delete('/destroy/{id}', 'Admin\ReviewerController@destroy')->name('admin_reviewer_destroy');
                        Route::put('/suspend/{id}', 'Admin\ReviewerController@suspend')->name('admin_reviewer_suspend');
                    });

                    Route::group(['prefix' => 'plotting'], function () {
                        Route::get('/', 'Admin\PlottingReviewerController@index')->name('admin_plotting_reviewer');
                        Route::get('/{id}/give', 'Admin\PlottingReviewerController@give_reviewer')->name('admin_plotting_give_reviewer');
                        Route::patch('/{id}/give', 'Admin\PlottingReviewerController@give_reviewer_update')->name('admin_plotting_give_reviewer_update');
                    });

                    Route::group(['prefix' => 'monev'], function () {
                        Route::get('/', 'Admin\PlottingReviewerController@index_monev')->name('admin_plotting_monev_reviewer');
                        Route::get('/{id}/give', 'Admin\PlottingReviewerController@give_monev_reviewer')->name('admin_plotting_monev_give_reviewer');
                        Route::patch('/{id}/give', 'Admin\PlottingReviewerController@give_monev_reviewer_update')->name('admin_plotting_monev_give_reviewer_update');
                    });
                });

                //Pengusul
                Route::group(['prefix' => 'pengusul'], function () {
                    Route::get('/', 'Admin\PengusulController@index')->name('admin_pengusul');
                    Route::get('/insert', 'Admin\PengusulController@insert')->name('admin_pengusul_insert');
                    Route::post('/store', 'Admin\PengusulController@store')->name('admin_pengusul_store');
                    Route::get('/edit/{id}', 'Admin\PengusulController@edit')->name('admin_pengusul_edit');
                    Route::patch('/edit/{id}', 'Admin\PengusulController@update')->name('admin_pengusul_update');
                    Route::delete('/destroy/{id}', 'Admin\PengusulController@destroy')->name('admin_pengusul_destroy');
                    Route::put('/suspend/{id}', 'Admin\PengusulController@suspend')->name('admin_pengusul_suspend');
                });

                // Waktu Pelaksanaan
                Route::group(['prefix' => 'waktu_pelaksanaan'], function () {
                    Route::get('/', 'Admin\WaktuPelaksanaanController@index')->name('admin_waktu_pelaksanaan');
                    Route::get('/{id}/edit', 'Admin\WaktuPelaksanaanController@edit')->name('admin_waktu_pelaksanaan_edit');
                    Route::patch('/{id}/update', 'Admin\WaktuPelaksanaanController@update')->name('admin_waktu_pelaksanaan_update');
                });
                
                //Lama Kegiatan
                Route::group(['prefix' => 'lama_kegiatan'], function () {
                    Route::get('/', 'Admin\LamaKegiatanController@index')->name('admin_lama_kegiatan');
                    Route::get('/insert', 'Admin\LamaKegiatanController@insert')->name('admin_lama_kegiatan_insert');
                    Route::post('/store', 'Admin\LamaKegiatanController@store')->name('admin_lama_kegiatan_store');
                    Route::get('/{id}/edit', 'Admin\LamaKegiatanController@edit')->name('admin_lama_kegiatan_edit');
                    Route::patch('/{id}/update', 'Admin\LamaKegiatanController@update')->name('admin_lama_kegiatan_update');
                    Route::delete('/{id}/destroy', 'Admin\LamaKegiatanController@destroy')->name('admin_lama_kegiatan_destroy');
                });
                //Template Dokumen
                Route::group(['prefix' => 'template_dokumen'], function () {
                    Route::get('/', 'Admin\TemplateDokumenController@index')->name('admin_template_dokumen');
                    // Route::post('/store', 'Admin\TemplateDokumenController@store')->name('admin_template_dokumen_store');
                    // Route::get('/insert', 'Admin\TemplateDokumenController@insert')->name('admin_template_dokumen_insert');
                    Route::get('/{id}/edit', 'Admin\TemplateDokumenController@edit')->name('admin_template_dokumen_edit');
                    Route::patch('/{id}/update', 'Admin\TemplateDokumenController@update')->name('admin_template_dokumen_update');
                    Route::patch('/{id}/destroy', 'Admin\TemplateDokumenController@destroy')->name('admin_template_dokumen_destroy');
                });
            });
        });
        // END ADMIN

        //REVIEWER
        Route::group(['middleware' => ['is_Reviewer']], function () {
            Route::group(['prefix' => 'reviewer'], function () {
                //Dashboard
                Route::group(['prefix' => 'dashboard'], function () {
                    Route::get('/', 'Reviewer\DashboardController@index')->name('reviewer_dashboard');
                });

                //Penelitian
                Route::group(['prefix' => 'penelitian'], function () {
                    Route::get('/', 'Reviewer\PenelitianController@index')->name('reviewer_penelitian');

                    Route::group(['middleware' => ['is_Unlock_Nilai_Usulan']], function () {
                        Route::get('/{id}/detail', 'Reviewer\PenelitianController@detail')->name('reviewer_penelitian_detail');
                        Route::get('/{id}/nilai', 'Reviewer\PenelitianController@nilai')->name('reviewer_penelitian_nilai');
                        Route::patch('/{id}/nilai', 'Reviewer\PenelitianController@nilai_update')->name('reviewer_penelitian_nilai_update');
                        Route::get('/{id}/nilai/ulasan', 'Reviewer\PenelitianController@nilai_ulasan')->name('reviewer_penelitian_nilai_ulasan');
                        Route::patch('/{id}/nilai/ulasan', 'Reviewer\PenelitianController@nilai_ulasan_update')->name('reviewer_penelitian_nilai_ulasan_update');

                        // Route::get('/{id}/download/{file_name}/{file_category}', 'Reviewer\PenelitianController@file_download')->name('reviewer_penelitian_file_download');
                        // Route::get('/{id}/preview/{file_name}/{file_category}', 'Reviewer\PenelitianController@file_preview')->name('reviewer_penelitian_file_preview');
                    });
                });

                //Monev
                Route::group(['prefix' => 'monev'], function () {
                    Route::get('/', 'Reviewer\MonevController@index')->name('reviewer_monev');

                    Route::group(['middleware' => ['is_Unlock_Monev_Penelitian']], function () {
                        Route::get('/{id}/detail', 'Reviewer\MonevController@detail')->name('reviewer_monev_detail');
                        Route::get('/{id}/nilai', 'Reviewer\MonevController@nilai')->name('reviewer_monev_nilai');
                        Route::patch('/{id}/nilai', 'Reviewer\MonevController@nilai_update')->name('reviewer_monev_nilai_update');
                        Route::get('/{id}/capaian', 'Reviewer\MonevController@capaian')->name('reviewer_monev_capaian');
                        Route::patch('/{id}/capaian', 'Reviewer\MonevController@capaian_update')->name('reviewer_monev_capaian_update');
                        Route::get('/{id}/nilai/ulasan', 'Reviewer\MonevController@nilai_ulasan')->name('reviewer_monev_nilai_ulasan');
                        Route::patch('/{id}/nilai/ulasan', 'Reviewer\MonevController@nilai_ulasan_update')->name('reviewer_monev_nilai_ulasan_update');
                    });
                });

                //Biodata
                Route::group(['prefix' => 'biodata'], function () {
                    Route::get('/edit', 'Reviewer\BiodataController@edit')->name('reviewer_biodata_edit');
                    Route::patch('/update', 'Reviewer\BiodataController@update')->name('reviewer_biodata_update');
                    Route::patch('/update/picture', 'Reviewer\BiodataController@update_picture')->name('reviewer_biodata_update_picture');
                });
            });
        });
        // END REVIEWER

        //PENGUSUL
        Route::group(['middleware' => ['is_Pengusul']], function () {
            Route::group(['prefix' => 'pengusul'], function () {

                //Dashboard
                Route::group(['prefix' => '/dashboard'], function () {
                    Route::get('/', 'Pengusul\DashboardController@index')->name('pengusul_dashboard');
                });

                //Penelitian
                Route::group(['prefix' => 'penelitian'], function () {
                    Route::get('/', 'Pengusul\PenelitianController@index')->name('pengusul_penelitian');
                    Route::get('/riwayat', 'Pengusul\PenelitianController@riwayat')->name('pengusul_penelitian_riwayat');
                    Route::get('/detail/{id}/view/{back_param}', 'Pengusul\PenelitianController@detail')->name('pengusul_penelitian_detail');

                    Route::delete('/{id}/hapus', 'Pengusul\PenelitianController@hapus')->name('pengusul_penelitian_hapus');

                     Route::group(['middleware' => ['is_Unlock_Tambah_Usulan', 'is_Suspend']], function () {
                        // Route::get('/tambah', 'Pengusul\PenelitianController@tambah')->name('pengusul_penelitian_tambah');
                        Route::post('/tambah', 'Pengusul\PenelitianController@store')->name('pengusul_penelitian_store');
                        // Route::patch('/usulan/1/{id}', 'Pengusul\PenelitianController@update')->name('pengusul_penelitian_update');
                        // Route::get('/usulan/{page}/{id}', 'Pengusul\PenelitianController@usulan')->name('pengusul_penelitian_usulan');
                        Route::get('/tambah', 'Pengusul\PenelitianController@tambah')->name('pengusul_penelitian_tambah');

                        Route::group(['middleware' => ['is_Not_Pending', 'is_Owner']], function () {
                            Route::patch('/usulan/1/{id}', 'Pengusul\PenelitianController@update')->name('pengusul_penelitian_update');
                            Route::get('/usulan/{page}/{id}', 'Pengusul\PenelitianController@usulan')->name('pengusul_penelitian_usulan');

                            Route::get('/usulan/{id}/member/add', 'Pengusul\PenelitianController@tambah_anggota')->name('pengusul_penelitian_tambah_anggota');
                            Route::post('/usulan/{id}/member/add', 'Pengusul\PenelitianController@store_anggota')->name('pengusul_penelitian_store_anggota');
                            Route::delete('/usulan/{id}/member/remove/{removeid}', 'Pengusul\PenelitianController@remove_anggota')->name('pengusul_penelitian_remove_anggota');

                        // Route::post('/usulan/{id}/upload/dokumen', 'Pengusul\PenelitianController@upload_dokumen')->name('pengusul_penelitian_upload_dokumen');

                        // Route::post('/usulan/{id}/upload/rab', 'Pengusul\PenelitianController@upload_rab')->name('pengusul_penelitian_upload_rab');
                            Route::post('/usulan/{id}/upload/dokumen', 'Pengusul\PenelitianController@upload_dokumen')->name('pengusul_penelitian_upload_dokumen');

                        // Route::get('/usulan/{id}/mitra/tambah', 'Pengusul\PenelitianController@tambah_mitra')->name('pengusul_penelitian_tambah_mitra');
                        // Route::post('/usulan/{id}/mitra/tambah', 'Pengusul\PenelitianController@store_tambah_mitra')->name('pengusul_penelitian_store_tambah_mitra');
                        // Route::get('/usulan/{id}/mitra/edit/{editid}', 'Pengusul\PenelitianController@edit_mitra')->name('pengusul_penelitian_edit_mitra');
                        // Route::patch('/usulan/{id}/mitra/edit/{editid}', 'Pengusul\PenelitianController@update_mitra')->name('pengusul_penelitian_update_mitra');
                        // Route::patch('/usulan/{id}/mitra/upload', 'Pengusul\PenelitianController@upload_dokumen_mitra')->name('pengusul_penelitian_upload_dokumen_mitra');
                        // Route::delete('/usulan/{id}/mitra/hapus/{removeid}', 'Pengusul\PenelitianController@hapus_mitra')->name('pengusul_penelitian_hapus_mitra');
                            Route::post('/usulan/{id}/upload/rab', 'Pengusul\PenelitianController@upload_rab')->name('pengusul_penelitian_upload_rab');

                        // Route::post('/usulan/{id}/submit', 'Pengusul\PenelitianController@usulan_submit')->name('pengusul_penelitian_submit');
                            Route::get('/usulan/{id}/mitra/tambah', 'Pengusul\PenelitianController@tambah_mitra')->name('pengusul_penelitian_tambah_mitra');
                            Route::post('/usulan/{id}/mitra/tambah', 'Pengusul\PenelitianController@store_tambah_mitra')->name('pengusul_penelitian_store_tambah_mitra');
                            Route::get('/usulan/{id}/mitra/edit/{editid}', 'Pengusul\PenelitianController@edit_mitra')->name('pengusul_penelitian_edit_mitra');
                            Route::patch('/usulan/{id}/mitra/edit/{editid}', 'Pengusul\PenelitianController@update_mitra')->name('pengusul_penelitian_update_mitra');
                            Route::patch('/usulan/{id}/mitra/upload', 'Pengusul\PenelitianController@upload_dokumen_mitra')->name('pengusul_penelitian_upload_dokumen_mitra');
                            Route::delete('/usulan/{id}/mitra/hapus/{removeid}', 'Pengusul\PenelitianController@hapus_mitra')->name('pengusul_penelitian_hapus_mitra');

                            Route::post('/usulan/{id}/submit', 'Pengusul\PenelitianController@usulan_submit')->name('pengusul_penelitian_submit');

                            Route::get('/usulan/{id}/luaran/tambah/{tipe}', 'Pengusul\PenelitianController@tambah_luaran')->name('pengusul_penelitian_tambah_luaran');
                            Route::post('/usulan/{id}/luaran/tambah/{tipe}', 'Pengusul\PenelitianController@store_luaran')->name('pengusul_penelitian_store_luaran');
                            Route::get('/usulan/{id}/luaran/{luaran_id}/edit/{tipe}', 'Pengusul\PenelitianController@edit_luaran')->name('pengusul_penelitian_edit_luaran');
                            Route::patch('/usulan/{id}/luaran/{luaran_id}/edit/{tipe}', 'Pengusul\PenelitianController@update_luaran')->name('pengusul_penelitian_update_luaran');
                            Route::delete('/usulan/{id}/luaran/{luaran_id}/destroy', 'Pengusul\PenelitianController@destroy_luaran')->name('pengusul_penelitian_destroy_luaran');
                        });

                        Route::post('/usulan/mitra/get/kabupaten', 'Pengusul\PenelitianController@get_kabupaten')->name('pengusul_penelitian_get_kabupaten');
                        Route::post('/usulan/mitra/get/kecamatan', 'Pengusul\PenelitianController@get_kecamatan')->name('pengusul_penelitian_get_kecamatan');
                        Route::post('/usulan/mitra/get/desa', 'Pengusul\PenelitianController@get_desa')->name('pengusul_penelitian_get_desa');

                        Route::get('usulan/{id}/download/{file_name}/{file_category}', 'Pengusul\PenelitianController@file_download')->name('pengusul_penelitian_file_download');
                        Route::get('usulan/{id}/preview/{file_name}/{file_category}', 'Pengusul\PenelitianController@file_preview')->name('pengusul_penelitian_file_preview');

                        // Route::get('/usulan/{id}/luaran/tambah/{tipe}', 'Pengusul\PenelitianController@tambah_luaran')->name('pengusul_penelitian_tambah_luaran');
                        // Route::post('/usulan/{id}/luaran/tambah/{tipe}', 'Pengusul\PenelitianController@store_luaran')->name('pengusul_penelitian_store_luaran');
                        // Route::get('/usulan/{id}/luaran/{luaran_id}/edit/{tipe}', 'Pengusul\PenelitianController@edit_luaran')->name('pengusul_penelitian_edit_luaran');
                        // Route::patch('/usulan/{id}/luaran/{luaran_id}/edit/{tipe}', 'Pengusul\PenelitianController@update_luaran')->name('pengusul_penelitian_update_luaran');
                        // Route::delete('/usulan/{id}/luaran/{luaran_id}/destroy', 'Pengusul\PenelitianController@destroy_luaran')->name('pengusul_penelitian_destroy_luaran');
                        Route::post('/usulan/luaran/get/jenis', 'Pengusul\PenelitianController@get_luaran_jenis')->name('pengusul_penelitian_luaran_get_jenis');
                        Route::post('/usulan/luaran/get/status', 'Pengusul\PenelitianController@get_luaran_status')->name('pengusul_penelitian_luaran_get_status');
                        


                    });
                });

                //Laporan Kemajuan
                Route::group(['prefix' => 'laporan_kemajuan'], function () {
                    Route::get('/', 'Pengusul\LaporanKemajuanController@index')->name('pengusul_laporan_kemajuan');
                    
                    Route::group(['middleware' => ['is_Suspend', 'is_Diterima', 'is_Unlock_Tambah_Laporan_Kemajuan']], function () {
                        Route::get('/{penelitian_id}/list', 'Pengusul\LaporanKemajuanController@list')->name('pengusul_laporan_kemajuan_list');
                        Route::get('/{penelitian_id}/{id}/insert/{tipe}', 'Pengusul\LaporanKemajuanController@insert')->name('pengusul_laporan_kemajuan_insert');
                        Route::post('/{penelitian_id}/{id}/store/{tipe}', 'Pengusul\LaporanKemajuanController@store')->name('pengusul_laporan_kemajuan_store');
                    });
                });

                //Laporan Akhir
                Route::group(['prefix' => 'laporan_akhir'], function () {
                    Route::get('/', 'Pengusul\LaporanAkhirController@index')->name('pengusul_laporan_akhir');
                    // Route::get('/insert', 'Pengusul\LaporanAkhirController@insert')->name('pengusul_laporan_akhir_insert');
                    // Route::patch('/update', 'Pengusul\LaporanAkhirController@update')->name('pengusul_laporan_akhir_upload_update');

                    Route::group(['middleware' => ['is_Suspend', 'is_Unlock_Tambah_Laporan_Akhir']], function () {
                        // Route::get('/insert', 'Pengusul\LaporanAkhirController@insert')->name('pengusul_laporan_akhir_insert');
                        Route::post('/update', 'Pengusul\LaporanAkhirController@update')->name('pengusul_laporan_akhir_upload_update');
                        Route::patch('/update/{penelitian_id}', 'Pengusul\LaporanAkhirController@update');
                    });
                });

                //Logbook
                Route::group(['prefix' => 'logbook'], function () {
                    Route::get('/', 'Pengusul\LogbookController@index')->name('pengusul_logbook');
    

                    Route::group(['prefix' =>'{penelitian_id}'], function () {
                        Route::group(['middleware' => ['is_Suspend', 'is_Diterima', 'is_Unlock_Tambah_Logbook']], function () {
                            Route::get('/detail', 'Pengusul\LogbookController@logbook_index')->name('pengusul_logbook_detail');
                            Route::get('/detail/{id}/uraian', 'Pengusul\LogbookController@logbook_uraian')->name('pengusul_logbook_detail_uraian');
                            Route::get('/insert', 'Pengusul\LogbookController@logbook_insert')->name('pengusul_logbook_detail_insert');
                            Route::post('/insert', 'Pengusul\LogbookController@logbook_store')->name('pengusul_logbook_detail_store');
                            Route::get('/{id}/edit', 'Pengusul\LogbookController@logbook_edit')->name('pengusul_logbook_detail_edit');
                            Route::patch('/{id}/edit', 'Pengusul\LogbookController@logbook_update')->name('pengusul_logbook_detail_update');
                            Route::delete('/{id}/destroy', 'Pengusul\LogbookController@logbook_destroy')->name('pengusul_logbook_detail_destroy');

                            // Logbook Berkas
                            Route::post('/insert/berkas', 'Pengusul\LogbookController@logbook_store_berkas')->name('pengusul_logbook_detail_store_berkas');
                        });
                    });
                });

                //Biodata
                Route::group(['prefix' => '/biodata'], function () {
                    Route::get('/edit', 'Pengusul\BiodataController@edit')->name('pengusul_biodata_edit');
                    Route::patch('/update', 'Pengusul\BiodataController@update')->name('pengusul_biodata_update');
                    Route::patch('/update/picture', 'Pengusul\BiodataController@update_picture')->name('pengusul_biodata_update_picture');
                });
            });
        });
        // END PENGUSUL

        //Profile
        Route::group(['prefix' => 'u'], function () {
            Route::get('/{id}', 'ProfileController@index')->name('profile');
            Route::get('/{id}/setting', 'ProfileController@setting')->name('profile_setting');
            Route::patch('/{id}/setting', 'ProfileController@profile_update')->name('profile_setting_update');
            Route::put('/{id}/setting', 'ProfileController@password_update')->name('profile_setting_update_password');
            Route::patch('/{id}/setting/picture', 'ProfileController@picture_update')->name('profile_setting_update_picture');
        });

        //ERROR PAGE
        //403 Forbidden Page
        Route::get('/forbidden', 'ErrorController@forbidden')->name('forbidden');

        //404 Not Found Page
        Route::get('/notfound', 'ErrorController@not_found')->name('not_found');

        //Suspend
        Route::get('/suspend', 'ErrorController@suspend')->name('suspend');
        // END ERROR PAGE

        //Coming Soon
        Route::get('/comingsoon', 'ErrorController@coming_soon')->name('coming_soon');
        // END ERROR PAGE

        // FILE
        Route::group(['prefix' => 'file'], function () {
            Route::get('/{id}/download/{file_name}/{file_category}', 'FileController@file_download')->name('file_download');
            Route::get('/{id}/preview/{file_name}/{file_category}', 'FileController@file_preview')->name('file_preview');
        });
        // END FILE
    });
});
