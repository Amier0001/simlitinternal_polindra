<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';
    protected $primaryKey = 'prodi_id';

    protected $fillable = [
        'prodi_jurusan_id',
        'prodi_nama',
    ];

    public function jurusan()
    {
        return $this->belongsTo('App\Models\Jurusan', 'prodi_jurusan_id');
    }
}
