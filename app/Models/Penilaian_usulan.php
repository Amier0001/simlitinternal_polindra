<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian_usulan extends Model
{
    protected $table = 'penilaian_usulan';
    protected $primaryKey = 'penilaian_usulan_id';

    protected $fillable = [
        'penilaian_usulan_penelitian_id',
        'penilaian_usulan_lock',
        'penilaian_usulan_komentar',
        'penilaian_usulan_nilai_1',
        'penilaian_usulan_nilai_2',
        'penilaian_usulan_nilai_3',
        'penilaian_usulan_nilai_4',
        'penilaian_usulan_nilai_5',
        'penilaian_usulan_nilai_6',
    ];

    public function usulan_penelitian()
    {
        return $this->belongsTo('App\Models\Usulan_penelitian', 'penilaian_usulan_penelitian_id');
    }
}
