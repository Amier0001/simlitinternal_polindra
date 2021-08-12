<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan_kemajuan extends Model
{
    protected $primaryKey = 'laporan_kemajuan_id';
    public $table = 'laporan_kemajuan';

    protected $fillable = [
        'laporan_kemajuan_penelitian_id',
        'laporan_kemajuan_date',
        'laporan_kemajuan_tipe',
        'laporan_kemajuan_original_name',
        'laporan_kemajuan_hash_name',
        'laporan_kemajuan_base_name',
        'laporan_kemajuan_file_size',
        'laporan_kemajuan_extension',
    ];

    public function usulan_penelitian()
    {
        return $this->belongsTo('App\Models\usulan_penelitian', 'laporan_kemajuan_penelitian_id');
    }
}
