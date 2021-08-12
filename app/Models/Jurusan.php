<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'jurusan_id';

    protected $fillable = [
        'jurusan_nama',
    ];

    public function mitra_sasaran()
    {
        return $this->hasMany('App\Models\Prodi', 'prodi_jurusan_id');
    }
}
