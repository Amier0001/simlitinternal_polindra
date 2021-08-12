<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lama_kegiatan extends Model
{
    protected $table = 'lama_kegiatan';
    protected $primaryKey = 'lama_kegiatan_id';

    protected $fillable = [
        'lama_kegiatan_tahun',
    ];
}
