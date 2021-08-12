<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $primaryKey = 'biodata_id';
    public $table = 'biodata';

    protected $fillable = [
        'biodata_user_id',
        'biodata_sex',
        'biodata_institusi',
        'biodata_jurusan',
        'biodata_program_studi',
        'biodata_jabatan',
        'biodata_pendidikan',
        'biodata_alamat',
        'biodata_tempat_lahir',
        'biodata_tanggal_lahir',
        'biodata_no_ktp',
        'biodata_no_hp',
        'biodata_no_telp',
        'biodata_web_personal',
        'biodata_scopus_id',
        'biodata_google_schoolar_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'biodata_user_id');
    }
}
