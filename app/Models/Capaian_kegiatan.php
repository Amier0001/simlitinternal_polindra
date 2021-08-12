<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capaian_kegiatan extends Model
{
    protected $table = 'capaian_kegiatan';
    protected $primaryKey = 'capaian_kegiatan_id';

    protected $fillable = [
        'capaian_kegiatan_monev_id',
        'mitra_kegiatan',
        'jumlah_mitra',
        'pendidikan_mitra',
        'persoalan_mitra',
        'status_sosial_mitra',
        'jarak_lokasi_mitra',
        'sarana_transportasi',
        'sarana_komunikasi',
        'jumlah_dosen',
        'jumlah_mahasiswa',
        'gelar_akademik_tim',
        'gender',
        'metode_pelaksanaan_kegiatan',
        'waktu_efektif_pelaksanaan_kegiatan',
        'keberhasilan',
        'keberlanjutan_kegiatan_mitra',
        'kapasitas_produksi',
        'omzet_perbulan',
        'persoalan_masyarakat_mitra',
        'biaya_pnbp',
        'biaya_sumber_lain',
        'tahapan_pencairan_dana',
        'jumlah_dana',
        'peran_serta_mitra',
        'kontribusi_pendanaan',
        'peranan_mitra',
        'alasan_kelanjutan_kegiatan',
        'model_usulan_kegiatan',
        'anggaran_biaya',
        'lain_lain',
        'kegiatan_yang_dinilai',
        'potret_permasalahan',
        'jasa',
        'metode',
        'produk',
        'paten',
        'publikasi_artikel',
        'publikasi_media_massa'
    ];

    public function penilaian_monev()
    {
        return $this->belongsTo('App\Models\Penilaian_monev', 'capaian_kegiatan_monev_id');
    }
}
