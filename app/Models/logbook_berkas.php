<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook_berkas extends Model
{
    protected $primaryKey = 'logbook_berkas_id';
    public $table = 'logbook_berkas';

    protected $fillable = [
        'logbook_berkas_penelitian_id',
        'logbook_berkas_date',
        'logbook_berkas_keterangan',
        'logbook_berkas_original_name',
        'logbook_berkas_hash_name',
        'logbook_berkas_base_name',
        'logbook_berkas_file_size',
        'logbook_berkas_extension',
    ];

    public function usulan_penelitian()
    {
        return $this->belongsTo('App\Models\Usulan_penelitian', 'logbook_berkas_penelitian_id');
    }
}