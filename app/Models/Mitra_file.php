<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mitra_file extends Model
{
    protected $table = 'mitra_file';
    protected $primaryKey = 'mitra_file_id';

    protected $fillable = [
        'mitra_file_mitra_sasaran_id',
        // 'mitra_file_kategori',
        'mitra_sasaran_file_original_name',
        'mitra_sasaran_file_hash_name',
        'mitra_sasaran_file_base_name',
        'mitra_sasaran_file_size',
        'mitra_sasaran_file_extension',
        'mitra_sasaran_file_date',
    ];

    public function mitra_sasaran()
    {
        return $this->belongsTo('App\Models\Usulan_penelitian', 'mitra_file_mitra_sasaran_id ');
    }
}
