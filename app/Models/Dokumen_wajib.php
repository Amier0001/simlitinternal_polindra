<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Dokumen_wajib extends Model
{
     protected $table = 'luaran_wajib';
    protected $primaryKey = 'luaran_wajib_id';

    protected $fillable = [
        'usulan_luaran_penelitian_id',
        // 'mitra_file_kategori',
        'usulan_luaran_penelitian_file_original_name',
        'usulan_luaran_penelitian_file_hash_name',
        'usulan_luaran_penelitian_file_base_name',
        'usulan_luaran_penelitian_file_size',
        'usulan_luaran_penelitian_file_extension',
        'usulan_luaran_penelitian_file_date',
    ];

    public function usulan_penelitian()
    {
        return $this->belongsTo('App\Models\Usulan_penelitian', 'usulan_luaran_penelitian_id');
    }
}