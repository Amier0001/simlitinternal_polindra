<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usulan_luaran extends Model
{
     protected $table = 'usulan_luaran';
    protected $primaryKey = 'usulan_luaran_id';

    protected $fillable = [
        'usulan_luaran_penelitian_id',
        'usulan_luaran_penelitian_tipe',
        'usulan_luaran_penelitian_tahun',
        'usulan_luaran_penelitian_kategori',
        'usulan_luaran_penelitian_jenis',
        'usulan_luaran_penelitian_rencana',
        'usulan_luaran_penelitian_status',
    ];

    public function usulan_penelitian()
    {
        return $this->belongsTo('App\Models\Usulan_penelitian', 'usulan_luaran_penelitian_id');
    }

    public function laporan_luaran()
    {
        return $this->hasOne('App\Models\Laporan_luaran', 'laporan_luaran_luaran_id');
    }
}
