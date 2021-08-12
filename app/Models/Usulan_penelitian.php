<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usulan_penelitian extends Model
{
    protected $table = 'usulan_penelitian';
    protected $primaryKey = 'usulan_penelitian_id';
    public $incrementing = false;

    protected $fillable = [
        'usulan_penelitian_id',
        'usulan_penelitian_reviewer_id',
        'usulan_penelitian_judul',
        'usulan_penelitian_kategori',
        'usulan_penelitian_skema_id',
        'usulan_penelitian_bidang_id',
        'usulan_penelitian_lama_kegiatan',
        'usulan_penelitian_mahasiswa_terlibat',
        'usulan_penelitian_submit',
        'usulan_penelitian_status',
        'usulan_penelitian_tahun',
        'usulan_penelitian_unlock_pass',
        // 'usulan_penelitian_komentar',
    ];

    public function anggota_penelitian()
    {
        return $this->hasMany('App\Models\Anggota_penelitian', 'anggota_penelitian_penelitian_id');
    }

    public function usulan_luaran()
    {
        return $this->hasMany('App\Models\Usulan_luaran', 'usulan_luaran_penelitian_id');
    }

    public function dokumen_usulan()
    {
        return $this->hasOne('App\Models\Dokumen_usulan', 'dokumen_usulan_penelitian_id');
    }

    public function dokumen_rab()
    {
        return $this->hasOne('App\Models\Dokumen_rab', 'dokumen_rab_penelitian_id');
    }

    public function logbook()
    {
        return $this->hasMany('App\Models\Logbook', 'logbook_penelitian_id');
    }
    public function logbook_berkas()
    {
        return $this->hasMany('App\Models\Logbook_berkas', 'logbook_berkas_penelitian_id');
    }

    public function penilaian_monev()
    {
        return $this->hasOne('App\Models\Penilaian_monev', 'penilaian_monev_penelitian_id');
    }

    // public function capaian_kegiatan()
    // {
    //     return $this->hasMany('App\Models\Capaian_kegiatan', 'capaian_kegiatan_penelitian_id');
    // }

    public function laporan_kemajuan()
    {
        return $this->hasMany('App\Models\Laporan_kemajuan', 'laporan_kemajuan_penelitian_id');
    }

    public function laporan_akhir()
    {
        return $this->hasOne('App\Models\Laporan_akhir', 'laporan_akhir_penelitian_id');
    }

    public function mitra_sasaran()
    {
        return $this->hasMany('App\Models\Mitra_sasaran', 'mitra_sasaran_penelitian_id');
    }

    public function penilaian_usulan()
    {
        return $this->hasOne('App\Models\Penilaian_usulan', 'penilaian_usulan_penelitian_id');
    }
    
}
