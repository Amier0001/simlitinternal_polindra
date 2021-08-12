<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Usulan_penelitian;
use App\Models\Anggota_penelitian;
use App\Models\Dokumen_usulan;
use App\Models\Laporan_kemajuan;
use App\Models\Penilaian_monev;
use App\Models\Dokumen_rab;
use App\Models\Mitra_sasaran;
use App\Models\Usulan_luaran;
use App\Models\Penilaian_usulan;
use App\Models\Capaian_kegiatan;

class MonevController extends Controller
{
    public function index()
    {
        $is_nilai_unlock = false;
        $nilai_unlock = get_where_local_db_json("unlock_feature.json", "name", __('unlock.monev_laporan_kemajuan_penelitian'));
        if ($nilai_unlock) {
            if (strtotime($nilai_unlock["start_time"]) <= strtotime(date('Y-m-d H:i:s')) &&  strtotime(date('Y-m-d H:i:s')) <= strtotime($nilai_unlock["end_time"])) {
                $is_nilai_unlock = true;
            }
        }

        $usulan_penelitian = Usulan_penelitian::where('usulan_penelitian_submit', true)
            ->where('usulan_penelitian_reviewer_monev_id', Session::get('user_id'))
            ->where('usulan_penelitian_status', '=', 'diterima')
            ->orderBy('usulan_penelitian_tahun', 'desc')
            ->orderBy('usulan_penelitian.updated_at', 'desc')
            ->get();

        $view_data = [
            'usulan_penelitian' => $usulan_penelitian,
            'is_nilai_unlock' => $is_nilai_unlock,
            'nilai_unlock' => $nilai_unlock,
        ];

        return view('reviewer.monev.index', $view_data);
    }

    public function detail($id)
    {
        $penelitian_id = $id;

        $laporan_kemajuan = Laporan_kemajuan::where('laporan_kemajuan_penelitian_id', $penelitian_id)->where('laporan_kemajuan_tipe', 'kemajuan')->first();

        $laporan_keuangan = Laporan_kemajuan::where('laporan_kemajuan_penelitian_id', $penelitian_id)->where('laporan_kemajuan_tipe', 'keuangan')->first();

        $luaran_wajib = Usulan_luaran::where('usulan_luaran_penelitian_id', $penelitian_id)
            ->where('usulan_luaran_penelitian_tipe', 'wajib')
            ->get();

        $luaran_tambahan = Usulan_luaran::where('usulan_luaran_penelitian_id', $penelitian_id)
            ->where('usulan_luaran_penelitian_tipe', 'tambahan')
            ->get();

        $usulan = Usulan_penelitian::where('usulan_penelitian_id', $id)
            ->join('skema_penelitian', 'usulan_penelitian.usulan_penelitian_skema_id', '=', 'skema_penelitian.skema_id')
            ->join('bidang_penelitian', 'usulan_penelitian.usulan_penelitian_bidang_id', '=', 'bidang_penelitian.bidang_id')
            ->first();

        $ketua = Anggota_penelitian::where('anggota_penelitian_penelitian_id', $id)
            ->join('users', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_penelitian_role', 'ketua')
            ->first();

        $anggota = Anggota_penelitian::where('anggota_penelitian_penelitian_id', $id)
            ->join('users', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_penelitian_role', '!=', 'ketua')
            ->orderBy('anggota_penelitian_role', 'asc')
            ->get();

        $view_data = [
            'laporan_kemajuan' => $laporan_kemajuan,
            'laporan_keuangan' => $laporan_keuangan,
            'luaran_wajib' => $luaran_wajib,
            'luaran_tambahan' => $luaran_tambahan,
            'penelitian_id' => $penelitian_id,
            'usulan' => $usulan,
            'ketua' => $ketua,
            'anggota' => $anggota,
        ];

        return view('reviewer.monev.detail', $view_data);
    }

    public function nilai($id)
    {
        // Check Is Penilaian Locked
        $penilaian_monev = Penilaian_monev::where('penilaian_monev_penelitian_id', $id)
            ->first();

        // $nilai = [];

        if ($penilaian_monev) {
            if ($penilaian_monev->penilaian_monev_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Penilaian Monev Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_monev');
            }
        }

        $ketua = Anggota_penelitian::where('anggota_penelitian_penelitian_id', $id)
            ->join('users', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_penelitian_role', 'ketua')
            ->first();

        $usulan = Usulan_penelitian::where('usulan_penelitian_id', $id)
            ->join('skema_penelitian', 'usulan_penelitian.usulan_penelitian_skema_id', '=', 'skema_penelitian.skema_id')
            ->join('bidang_penelitian', 'usulan_penelitian.usulan_penelitian_bidang_id', '=', 'bidang_penelitian.bidang_id')
            ->first();

        $anggota = Anggota_penelitian::where('anggota_penelitian_penelitian_id', $id)
            ->join('users', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_penelitian_role', '!=', 'ketua')
            ->orderBy('anggota_penelitian_role', 'asc')
            ->get();

        $view_data = [
            'anggota' => $anggota,
            'usulan' => $usulan,
            'ketua' => $ketua,
            'id' => $id,
            'nilai' => $penilaian_monev,
        ];

        return view('reviewer.monev.nilai', $view_data);
    }

    public function nilai_update(Request $request, $id)
    {
        // Check Is Penilaian Locked
        $is_lock = Penilaian_monev::where('penilaian_monev_penelitian_id', $id)
            ->first();

        if ($is_lock) {
            if ($is_lock->penilaian_monev_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Penilaian Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_monev');
            }
        }

        // Input Validation
        $request->validate(
            [
                'komentar'  => 'max:60000',
            ]
        );

        $status[1] = $request->status_1;
        $status[2] = $request->status_2;
        $status[3] = $request->status_3;
        $status[4] = $request->status_4;
        $status[5] = $request->status_5;
        

        $skor[1] = $request->skor_1;
        $skor[2] = $request->skor_2;
        $skor[3] = $request->skor_3;
        $skor[4] = $request->skor_4;
        $skor[5] = $request->skor_5;
        

        $komentar = htmlspecialchars($request->komentar);

        $nilai[1] = 0;
        $nilai[2] = 0;
        $nilai[3] = 0;
        $nilai[4] = 0;
        $nilai[5] = 0;
        

        // if ($skor[1] != NULL && $skor[2] != NULL) {
        //     $nilai_avg = ($skor[1] + $skor[2]) / 2;
        //     $nilai[1] = $nilai_avg * 20;
        //     $nilai[2] = $nilai_avg * 20;
        // } else if ($skor[1] != NULL) {
        //     $nilai_avg = ($skor[1]) / 1;
        //     $nilai[1] = $nilai_avg * 20;
        // } else if ($skor[2] != NULL) {
        //     $nilai_avg = ($skor[2]) / 1;
        //     $nilai[2] = $nilai_avg * 20;
        // } else {
        //     $nilai[1] = 0;
        //     $nilai[2] = 0;
        // }

        // if ($skor[3] != NULL && $skor[4] != NULL && $skor[5] != NULL && $skor[6] != NULL) {
        //     $nilai_avg = ($skor[3] + $skor[4] + $skor[5] + $skor[6]) / 4;
        //     $nilai[3] = $nilai_avg * 60;
        //     $nilai[4] = $nilai_avg * 60;
        //     $nilai[5] = $nilai_avg * 60;
        //     $nilai[6] = $nilai_avg * 60;
        // } elseif ($skor[3] != NULL && $skor[4] != NULL && $skor[5] != NULL) {
        //     $nilai_avg = ($skor[3] + $skor[4] + $skor[5]) / 3;
        //     $nilai[3] = $nilai_avg * 60;
        //     $nilai[4] = $nilai_avg * 60;
        //     $nilai[5] = $nilai_avg * 60;
        // } elseif ($skor[3] != NULL && $skor[5] != NULL && $skor[6] != NULL) {
        //     $nilai_avg = ($skor[3] + $skor[5] + $skor[6]) / 3;
        //     $nilai[3] = $nilai_avg * 60;
        //     $nilai[5] = $nilai_avg * 60;
        //     $nilai[6] = $nilai_avg * 60;
        // } elseif ($skor[3] != NULL && $skor[4] != NULL && $skor[6] != NULL) {
        //     $nilai_avg = ($skor[3] + $skor[4] + $skor[6]) / 3;
        //     $nilai[3] = $nilai_avg * 60;
        //     $nilai[4] = $nilai_avg * 60;
        //     $nilai[6] = $nilai_avg * 60;
        //     // 
        // } elseif ($skor[4] != NULL && $skor[5] != NULL && $skor[6] != NULL) {
        //     $nilai_avg = ($skor[4] + $skor[5] + $skor[6]) / 3;
        //     $nilai[4] = $nilai_avg * 60;
        //     $nilai[5] = $nilai_avg * 60;
        //     $nilai[6] = $nilai_avg * 60;
        // } elseif ($skor[3] != NULL && $skor[4] != NULL) {
        //     $nilai_avg = ($skor[3] + $skor[4]) / 2;
        //     $nilai[3] = $nilai_avg * 60;
        //     $nilai[4] = $nilai_avg * 60;
        // } elseif ($skor[3] != NULL && $skor[5] != NULL) {
        //     $nilai_avg = ($skor[3] + $skor[5]) / 2;
        //     $nilai[3] = $nilai_avg * 60;
        //     $nilai[5] = $nilai_avg * 60;
        // } elseif ($skor[3] != NULL && $skor[6] != NULL) {
        //     $nilai_avg = ($skor[3] + $skor[6]) / 2;
        //     $nilai[3] = $nilai_avg * 60;
        //     $nilai[6] = $nilai_avg * 60;
        //     // 
        // } elseif ($skor[4] != NULL && $skor[5] != NULL) {
        //     $nilai_avg = ($skor[4] + $skor[5]) / 2;
        //     $nilai[4] = $nilai_avg * 60;
        //     $nilai[5] = $nilai_avg * 60;
        // } elseif ($skor[4] != NULL && $skor[6] != NULL) {
        //     $nilai_avg = ($skor[4] + $skor[6]) / 2;
        //     $nilai[4] = $nilai_avg * 60;
        //     $nilai[6] = $nilai_avg * 60;
        //     // 
        // } elseif ($skor[5] != NULL && $skor[6] != NULL) {
        //     $nilai_avg = ($skor[5] + $skor[6]) / 2;
        //     $nilai[5] = $nilai_avg * 60;
        //     $nilai[6] = $nilai_avg * 60;
        //     // 
        // } elseif ($skor[3] != NULL) {
        //     $nilai_avg = ($skor[3]) / 1;
        //     $nilai[3] = $nilai_avg * 60;
        // } elseif ($skor[4] != NULL) {
        //     $nilai_avg = ($skor[4]) / 1;
        //     $nilai[4] = $nilai_avg * 60;
        // } elseif ($skor[5] != NULL) {
        //     $nilai_avg = ($skor[5]) / 1;
        //     $nilai[5] = $nilai_avg * 60;
        // } elseif ($skor[6] != NULL) {
        //     $nilai_avg = ($skor[6]) / 1;
        //     $nilai[6] = $nilai_avg * 60;
        //  // 
        // } else {
        //     $nilai[3] = 0;
        //     $nilai[4] = 0;
        //     $nilai[5] = 0;
        //     $nilai[6] = 0;
        // }

        // if ($skor[7] != NULL && $skor[8] != NULL) {
        //     $nilai_avg = ($skor[7] + $skor[8]) / 2;
        //     $nilai[7] = $nilai_avg * 20;
        //     $nilai[8] = $nilai_avg * 20;
        // } elseif ($skor[7] != NULL) {
        //     $nilai_avg = ($skor[7]) / 1;
        //     $nilai[7] = $nilai_avg * 20;
        // } elseif ($skor[8] != NULL) {
        //     $nilai_avg = ($skor[8]) / 1;
        //     $nilai[8] = $nilai_avg * 20;
        // } else {
        //     $nilai[7] = 0;
        //     $nilai[8] = 0;
        // }

        if ($skor[1] != NULL) {
            $nilai_avg = ($skor[1]) / 1;
            $nilai[1] = $nilai_avg * 30;
        } else {
            $nilai[1] = 0;
        }

        if ($skor[2] != NULL) {
            $nilai_avg = ($skor[2]) / 1;
            $nilai[2] = $nilai_avg * 20;
        } else {
            $nilai[2] = 0;
        }

        if ($skor[3] != NULL) {
            $nilai_avg = ($skor[3]) / 1;
            $nilai[3] = $nilai_avg * 20;
        } else {
            $nilai[3] = 0;
        }

        if ($skor[4] != NULL) {
            $nilai_avg = ($skor[4]) / 1;
            $nilai[4] = $nilai_avg * 10;
        } else {
            $nilai[4] = 0;
        }

        if ($skor[5] != NULL) {
            $nilai_avg = ($skor[5]) / 1;
            $nilai[5] = $nilai_avg * 20;
        } else {
            $nilai[5] = 0;
        }

        //Input Data
        $data = [
            'penilaian_monev_penelitian_id' => $id,
            'penilaian_monev_komentar' => $komentar,

            'penilaian_monev_status_1' => $status[1],
            'penilaian_monev_status_2' => $status[2],
            'penilaian_monev_status_3' => $status[3],
            'penilaian_monev_status_4' => $status[4],
            'penilaian_monev_status_5' => $status[5],
            
            'penilaian_monev_skor_1' => $skor[1],
            'penilaian_monev_skor_2' => $skor[2],
            'penilaian_monev_skor_3' => $skor[3],
            'penilaian_monev_skor_4' => $skor[4],
            'penilaian_monev_skor_5' => $skor[5],
            
            'penilaian_monev_nilai_1' => $nilai[1],
            'penilaian_monev_nilai_2' => $nilai[2],
            'penilaian_monev_nilai_3' => $nilai[3],
            'penilaian_monev_nilai_4' => $nilai[4],
            'penilaian_monev_nilai_5' => $nilai[5],
            
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        Penilaian_monev::updateOrInsert(
            ['penilaian_monev_penelitian_id' => $id],
            $data
        );

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Nilai Monev Ditambah' //Sub Alert Message
        );

        return redirect()->route('reviewer_monev_capaian', $id);
    }

    public function capaian($id)
    {
        // Check Is Penilaian Locked
        $penilaian_monev = Penilaian_monev::where('penilaian_monev_penelitian_id', $id)->first();
        $capaian = NULL;

         if ($penilaian_monev) {
            if ($penilaian_monev->penilaian_monev_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Penilaian Monev Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_monev');
            }
            $capaian = Capaian_kegiatan::where('capaian_kegiatan_monev_id', $penilaian_monev->penilaian_monev_id)->first();
        } elseif ($penilaian_monev == NULL) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Monev Tidak Ditemukan', //Alert Message 
                'Mohon Isi Monev Terlebih Dahulu' //Sub Alert Message
            );

            return redirect()->route('reviewer_monev');
        }

        $ketua = Anggota_penelitian::where('anggota_penelitian_penelitian_id', $id)
            ->join('users', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_penelitian_role', 'ketua')
            ->first();

        $usulan = Usulan_penelitian::where('usulan_penelitian_id', $id)
            ->join('skema_penelitian', 'usulan_penelitian.usulan_penelitian_skema_id', '=', 'skema_penelitian.skema_id')
            ->join('bidang_penelitian', 'usulan_penelitian.usulan_penelitian_bidang_id', '=', 'bidang_penelitian.bidang_id')
            ->first();

        $anggota = Anggota_penelitian::where('anggota_penelitian_penelitian_id', $id)
            ->join('users', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_penelitian_role', '!=', 'ketua')
            ->orderBy('anggota_penelitian_role', 'asc')
            ->get();

        // $nilai = Penilaian_usulan::where('penilaian_usulan_penelitian_id', $id)->first();

        // $keterangan_nilai = [
        //     "1" => "Sangat Buruk",
        //     "2" => "Buruk Sekali",
        //     "3" => "Buruk",
        //     "4" => "Baik",
        //     "5" => "Baik Sekali",
        //     "6" => "Istimewa",
        // ];

        // $total_nilai = [
        //     "1" => $nilai->penilaian_usulan_nilai_1 * 10,
        //     "2" => $nilai->penilaian_usulan_nilai_2 * 15,
        //     "3" => $nilai->penilaian_usulan_nilai_3 * 20,
        //     "4" => $nilai->penilaian_usulan_nilai_4 * 25,
        //     "5" => $nilai->penilaian_usulan_nilai_5 * 10,
        //     "6" => $nilai->penilaian_usulan_nilai_6 * 20,
        // ];

        $view_data = [
            'anggota' => $anggota,
            'usulan' => $usulan,
            'ketua' => $ketua,
            // 'nilai' => $nilai,
            'id' => $id,
            'capaian' => $capaian,
            'nilai' => $penilaian_monev,
        ];

        return view('reviewer.monev.capaian_kegiatan', $view_data);
    }

    public function capaian_update(Request $request, $id)
    {
        // Check Is Penilaian Locked
        $is_lock = Penilaian_monev::where('penilaian_monev_penelitian_id', $id)
            ->first();

        if ($is_lock) {
            if ($is_lock->penilaian_monev_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Monev Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_monev');
            }
        }


        // Input Validation
        // $request->validate(
        //     [
        //         'komentar'  => 'max:60000',
        //     ]
        // );

        // $request->validate(
        //     [
        //         'mitra_kegiatan'  => 'max:255',
        //         'jumlah_mitra_orang'  => 'nullable|numeric|max:255',
                    // 'jumlah_mitra_usaha'  => 'nullable|numeric|max:255',
                    // 'pendidikan_mitra_s3'  => 'nullable|numeric|max:255',
                    // 'pendidikan_mitra_s2'  => 'nullable|numeric|max:255',
                    // 'pendidikan_mitra_s1'  => 'nullable|numeric|max:255',
                    // 'pendidikan_mitra_diploma'  => 'nullable|numeric|max:255',
                    // 'pendidikan_mitra_sma'  => 'nullable|numeric|max:255',
                    // 'pendidikan_mitra_smp'  => 'nullable|numeric|max:255',
                    // 'pendidikan_mitra_sd'  => 'nullable|numeric|max:255',
                    // 'pendidikan_mitra_ts'  => 'nullable|numeric|max:255',

        //         'persoalan_mitra'  => 'max:255',
        //         'status_sosial_mitra'  => 'max:255',

        //         'jarak_lokasi_mitra'  => 'max:255',
        //         'sarana_transportasi'  => 'max:255',
        //         'sarana_komunikasi'  => 'max:255',

        //         // IDENTITAS
        //           'jumlah_dosen'  => 'nullable|numeric|max:255',
        //            'jumlah_mahasiswa'  => 'nullable|numeric|max:255',
        //            'gelar_akademik_tim_s3'  => 'nullable|numeric|max:255',
        //            'gelar_akademik_tim_s2'  => 'nullable|numeric|max:255',
        //            'gelar_akademik_tim_s1'  => 'nullable|numeric|max:255',
        //            'gelar_akademik_tim_gb'  => 'nullable|numeric|max:255',
        //            'gender_pria'  => 'nullable|numeric|max:255',
        //            'gender_wanita'  => 'nullable|numeric|max:255',

        //         'metode_pelaksanaan_kegiatan'  => 'max:255',
        //         'waktu_efektif_pelaksanaan'  => 'max:255',
        //         'keberhasilan'  => 'max:255',
        //         'keberlanjutan_kegiatan'  => 'max:255',
        //         'kapasitas_produksi_sebelum'  => 'max:9999999999',
        //         'kapasitas_produksi_setelah'  => 'max:9999999999',
        //         'omzet_per_bulan_sebelum'  => 'max:9999999999',
        //         'omzet_per_bulan_setelah'  => 'max:9999999999',
        //         'persoalan_masyarakat_mitra'  => 'max:255',

        //         'biaya_pnbp'  => 'numeric|max:9999999999',
        //         'biaya_sumber_lain'  => 'numeric|max:9999999999',

        //         'tahap_pencairan_dana'  => 'max:255',
        //         'jumlah_dana'  => 'max:255',

        //         'peran_serta_mitra'  => 'max:255',
        //         'kontribusi_pendanaan'  => 'max:255',
        //         'peran_mitra'  => 'max:255',

        //         'alasan_kelanjutan_kegiatan'  => 'max:255',

        //         'model_usulan_kegiatan'  => 'max:255',
        //         'anggaran_biaya'  => 'numeric|max:255',
        //         'usul_lain_lain'  => 'max:255',

        //         'kegiatan_dinilai_bermanfaat'  => 'max:255',
        //         'permasalahan_lain_terekam'  => 'max:255',

        //         'jasa'  => 'max:255',
        //         'metode'  => 'max:255',
        //         'produk'  => 'max:255',
        //         'paten'  => 'max:255',
        //         'publikasi_artikel'  => 'max:255',
        //         'publikasi_media_masa'  => 'max:255',
        //     ]
        // );

        // PROGRESS START HERE

        // $mitra_kegiatan = htmlspecialchars($request->mitra_kegiatan);
        // $jumlah_mitra = json_encode([
        //     'orang' => htmlspecialchars($request->jumlah_mitra_orang),
        //     'usaha' => htmlspecialchars($request->jumlah_mitra_usaha)
        // ]);
        // $pendidikan_mitra = json_encode([
        //     's3' => htmlspecialchars($request->pendidikan_mitra_s3),
        //     's2' => htmlspecialchars($request->pendidikan_mitra_s2),
        //     's1' => htmlspecialchars($request->pendidikan_mitra_s1),
        //     'diploma' => htmlspecialchars($request->pendidikan_mitra_diploma),
        //     'sma' => htmlspecialchars($request->pendidikan_mitra_sma),
        //     'smp' => htmlspecialchars($request->pendidikan_mitra_smp),
        //     'sd' => htmlspecialchars($request->pendidikan_mitra_sd),
        //     'tidak_berpendidikan' => htmlspecialchars($request->pendidikan_mitra_ts)
        // ]);

        // $persoalan_mitra = htmlspecialchars($request->persoalan_mitra);
        // $status_sosial_mitra = htmlspecialchars($request->status_sosial_mitra);

        // $jarak_lokasi_mitra = htmlspecialchars($request->jarak_lokasi_mitra);
        // $sarana_transportasi = htmlspecialchars($request->sarana_transportasi);
        // $sarana_komunikasi = htmlspecialchars($request->sarana_komunikasi);

        // $jumlah_dosen = htmlspecialchars($request->jumlah_dosen);
        // $jumlah_mahasiswa = htmlspecialchars($request->jumlah_mahasiswa);
        // $gelar_akademik_tim = json_encode([
        //     's3' => htmlspecialchars($request->gelar_akademik_tim_s3),
        //     's2' => htmlspecialchars($request->gelar_akademik_tim_s2),
        //     's1' => htmlspecialchars($request->gelar_akademik_tim_s1),
        //     'gb' => htmlspecialchars($request->gelar_akademik_tim_gb)
        // ]);
        // $gender = json_encode([
        //     'pria' => htmlspecialchars($request->gender_pria),
        //     'wanita' => htmlspecialchars($request->gender_wanita)
        // ]);
        // $metode_pelaksanaan_kegiatan = htmlspecialchars($request->metode_pelaksanaan_kegiatan);
        // $waktu_efektif_pelaksanaan = htmlspecialchars($request->waktu_efektif_pelaksanaan);
        // $keberhasilan = htmlspecialchars($request->keberhasilan);
        // $keberlanjutan_kegiatan = htmlspecialchars($request->keberlanjutan_kegiatan);
        // $kapasitas_produksi = json_encode([
        //     'sebelum' => htmlspecialchars($request->kapasitas_produksi_sebelum),
        //     'setelah' => htmlspecialchars($request->kapasitas_produksi_setelah)
        // ]);
        // $omzet_per_bulan = json_encode([
        //     'sebelum' => htmlspecialchars($request->omzet_per_bulan_sebelum),
           // 'setelah' => htmlspecialchars($request->omzet_per_bulan_setelah)
        // ]);
        // $persoalan_masyarakat_mitra = htmlspecialchars($request->persoalan_masyarakat_mitra);

        // $biaya_pnbp = htmlspecialchars($request->biaya_pnbp);
        // $biaya_sumber_lain = htmlspecialchars($request->biaya_sumber_lain);

        // $tahap_pencairan_dana = htmlspecialchars($request->tahap_pencairan_dana);
        // $jumlah_dana = htmlspecialchars($request->jumlah_dana);

        // $peran_serta_mitra = htmlspecialchars($request->peran_serta_mitra);
        // $kontribusi_pendanaan = htmlspecialchars($request->kontribusi_pendanaan);
        // $peran_mitra = htmlspecialchars($request->peran_mitra);

        // $alasan_kelanjutan_kegiatan = htmlspecialchars($request->alasan_kelanjutan_kegiatan);

        // $model_usulan_kegiatan = htmlspecialchars($request->model_usulan_kegiatan);
        // $anggaran_biaya = htmlspecialchars($request->anggaran_biaya);
        // $usul_lain_lain = htmlspecialchars($request->usul_lain_lain);

        // $kegiatan_dinilai_bermanfaat = htmlspecialchars($request->kegiatan_dinilai_bermanfaat);
        // $permasalahan_lain_terekam = htmlspecialchars($request->permasalahan_lain_terekam);

        // $jasa = htmlspecialchars($request->jasa);
        // $metode = htmlspecialchars($request->metode);
        // $produk = htmlspecialchars($request->produk);
        // $paten = htmlspecialchars($request->paten);
        // $publikasi_artikel = htmlspecialchars($request->publikasi_artikel);
        // $publikasi_media_masa = htmlspecialchars($request->publikasi_media_masa);

        //$monev_id = $is_lock;

        // //Input Data
        // $data_insert = [
        //     'capaian_kegiatan_monev_id' => $monev_id->penilaian_monev_id,
        //     'mitra_kegiatan' => $mitra_kegiatan,
        //     'jumlah_mitra' => "$jumlah_mitra",
        //     'pendidikan_mitra' => "$pendidikan_mitra",
        //     'persoalan_mitra' => $persoalan_mitra,
        //     'status_sosial_mitra' => $status_sosial_mitra,
        //     'jarak_lokasi_mitra' => $jarak_lokasi_mitra,
        //     'sarana_transportasi' => $sarana_transportasi,
        //     'sarana_komunikasi' => $sarana_komunikasi,
        //     'jumlah_dosen' => $jumlah_dosen,
        //     'jumlah_mahasiswa' => $jumlah_mahasiswa,
        //     'gelar_akademik_tim' => "$gelar_akademik_tim",
        //     'gender' => "$gender",
        //     'metode_pelaksanaan_kegiatan' => $metode_pelaksanaan_kegiatan,
        //     'waktu_efektif_pelaksanaan_kegiatan' => $waktu_efektif_pelaksanaan,
        //     'keberhasilan' => $keberhasilan,
        //     'keberlanjutan_kegiatan_mitra' => $keberlanjutan_kegiatan,
        //     'kapasitas_produksi' => "$kapasitas_produksi",
        //     'omzet_perbulan' => "$omzet_per_bulan",
        //     'persoalan_masyarakat_mitra' => $persoalan_masyarakat_mitra,
        //     'biaya_pnbp' => $biaya_pnbp,
        //     'biaya_sumber_lain' => $biaya_sumber_lain,
        //     'tahapan_pencairan_dana' => $tahap_pencairan_dana,
        //     'jumlah_dana' => $jumlah_dana,
        //     'peran_serta_mitra' => $peran_serta_mitra,
        //     'kontribusi_pendanaan' => $kontribusi_pendanaan,
        //     'peranan_mitra' => $peran_mitra,
        //     'alasan_kelanjutan_kegiatan' => $alasan_kelanjutan_kegiatan,
        //     'model_usulan_kegiatan' => $model_usulan_kegiatan,
        //     'anggaran_biaya' => $anggaran_biaya,
        //     'lain_lain' => $usul_lain_lain,
        //     'kegiatan_yang_dinilai' => $kegiatan_dinilai_bermanfaat,
        //     'potret_permasalahan' => $permasalahan_lain_terekam,
        //     'jasa' => $jasa,
        //     'metode' => $metode,
        //     'produk' => $produk,
        //     'paten' => $paten,
        //     'publikasi_artikel' => $publikasi_artikel,
        //     'publikasi_media_massa' => $publikasi_media_masa
        // ];


        // Capaian_kegiatan::updateOrInsert(
        //     ['capaian_kegiatan_monev_id' => $monev_id->penilaian_monev_id],
        //     $data_insert
        // );

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Capaian Monev Ditambah' //Sub Alert Message
        );

        return redirect()->route('reviewer_monev_nilai_ulasan', $id);
    }
    
    public function nilai_ulasan($id)
    {
        // Check Is Penilaian Locked
        $is_lock = Penilaian_monev::where('penilaian_monev_penelitian_id', $id)
            ->first();

        if ($is_lock) {
            if ($is_lock->penilaian_usulan_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Penilaian Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_penelitian');
            }
        }

        $ketua = Anggota_penelitian::where('anggota_penelitian_penelitian_id', $id)
            ->join('users', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_penelitian_role', 'ketua')
            ->first();

        $usulan = Usulan_penelitian::where('usulan_penelitian_id', $id)
            ->join('skema_penelitian', 'usulan_penelitian.usulan_penelitian_skema_id', '=', 'skema_penelitian.skema_id')
            ->join('bidang_penelitian', 'usulan_penelitian.usulan_penelitian_bidang_id', '=', 'bidang_penelitian.bidang_id')
            ->first();

        $anggota = Anggota_penelitian::where('anggota_penelitian_penelitian_id', $id)
            ->join('users', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_penelitian.anggota_penelitian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_penelitian_role', '!=', 'ketua')
            ->orderBy('anggota_penelitian_role', 'asc')
            ->get();

        $nilai = Penilaian_monev::where('penilaian_monev_penelitian_id', $id)->first();

        $capaian = Capaian_kegiatan::where('capaian_kegiatan_monev_id', $nilai->penilaian_monev_id)->first();

        // $keterangan_nilai = [
        //     "1" => "Sangat Buruk",
        //     "2" => "Buruk Sekali",
        //     "3" => "Buruk",
        //     "4" => "Baik",
        //     "5" => "Baik Sekali",
        //     "6" => "Istimewa",
        // ];

        // $total_nilai = [
        //     "1" => $nilai->penilaian_usulan_nilai_1 * 10,
        //     "2" => $nilai->penilaian_usulan_nilai_2 * 15,
        //     "3" => $nilai->penilaian_usulan_nilai_3 * 20,
        //     "4" => $nilai->penilaian_usulan_nilai_4 * 25,
        //     "5" => $nilai->penilaian_usulan_nilai_5 * 10,
        //     "6" => $nilai->penilaian_usulan_nilai_6 * 20,
        // ];

        $view_data = [
            'anggota' => $anggota,
            'usulan' => $usulan,
            'ketua' => $ketua,
            'nilai' => $nilai,
            'id' => $id,
            // 'ket_nilai' => $keterangan_nilai,
            'capaian' => $capaian,
            // 'total_nilai' => $total_nilai,
        ];

        return view('reviewer.monev.ulasan_nilai', $view_data);
    }

    public function nilai_ulasan_update(Request $request, $id)
    {
        // Check Is Penilaian Locked
        $is_lock = Penilaian_monev::where('penilaian_monev_penelitian_id', $id)
            ->first();

        if ($is_lock) {
            if ($is_lock->penilaian_monev_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Monev Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_penelitian');
            }
        }

        //Input Data
        $data = [
            'penilaian_monev_penelitian_id' => $id,
            'penilaian_monev_lock' => true,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        Penilaian_monev::where('penilaian_monev_penelitian_id', $id)
            ->update($data);

        Usulan_penelitian::where('usulan_penelitian_id', $id)
            ->update(['usulan_penelitian_status' => 'dimonev']);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Nilai Monev Dikirimkan' //Sub Alert Message
        );

        return redirect()->route('reviewer_monev');
    }
}
