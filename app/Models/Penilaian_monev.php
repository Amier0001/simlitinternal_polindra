<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian_monev extends Model
{
    protected $table = 'penilaian_monev';
    protected $primaryKey = 'penilaian_monev_id';

    protected $fillable = [
        'penilaian_monev_penelitian_id',
        'penilaian_monev_lock',
        'penilaian_monev_komentar',
        // 'penilaian_monev_urutan',
        // 'penilaian_monev_kriteria',

        'penilaian_monev_status_1',
        'penilaian_monev_status_2',
        'penilaian_monev_status_3',
        'penilaian_monev_status_4',
        'penilaian_monev_status_5',
        'penilaian_monev_status_6',
        'penilaian_monev_status_7',
        'penilaian_monev_status_8',
        'penilaian_monev_status_9',

        'penilaian_monev_skor_1',
        'penilaian_monev_skor_2',
        'penilaian_monev_skor_3',
        'penilaian_monev_skor_4',
        'penilaian_monev_skor_5',
        'penilaian_monev_skor_6',
        'penilaian_monev_skor_7',
        'penilaian_monev_skor_8',
        'penilaian_monev_skor_9',

        'penilaian_monev_nilai_1',
        'penilaian_monev_nilai_2',
        'penilaian_monev_nilai_3',
        'penilaian_monev_nilai_4',
        'penilaian_monev_nilai_5',
        'penilaian_monev_nilai_6',
        'penilaian_monev_nilai_7',
        'penilaian_monev_nilai_8',
        'penilaian_monev_nilai_9',
    ];

    public function capaian_kegiatan()
    {
        return $this->hasMany('App\Models\Capaian_kegiatan', 'capaian_kegiatan_monev_id');
    }

    public function usulan_penelitian()
    {
        return $this->belongsTo('App\Models\Usulan_penelitian', 'penilaian_monev_penelitian_id');
    }
}
