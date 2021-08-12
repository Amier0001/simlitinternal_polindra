<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis_luaran extends Model
{
    protected $table = 'jenis_luaran';
    protected $primaryKey = 'jenis_luaran_id';

    protected $fillable = [
        'jenis_luaran_kategori_id',
        'jenis_luaran_label',
    ];

    public function kategori_luaran()
    {
        return $this->belongsTo('App\Models\Kategori_luaran', 'jenis_luaran_kategori_id');
    }
}
