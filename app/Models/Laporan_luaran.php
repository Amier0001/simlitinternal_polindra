<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan_luaran extends Model
{
    protected $primaryKey = 'laporan_luaran_id';
    public $table = 'laporan_luaran';

    protected $fillable = [
        'laporan_luaran_luaran_id',
        'laporan_kemajuan_date',
        'laporan_kemajuan_tipe',
        'laporan_kemajuan_original_name',
        'laporan_kemajuan_hash_name',
        'laporan_kemajuan_base_name',
        'laporan_kemajuan_file_size',
        'laporan_kemajuan_extension',
    ];

    public function usulan_luaran()
    {
        return $this->belongsTo('App\Models\Usulan_luaran', 'laporan_luaran_luaran_id');
    }
}
