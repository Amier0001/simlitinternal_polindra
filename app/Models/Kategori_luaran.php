<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori_luaran extends Model
{
    protected $table = 'kategori_luaran';
    protected $primaryKey = 'kategori_luaran_id';

    protected $fillable = [
        'kategori_luaran_label',
        'kategori_luaran_required',
    ];

    public function jenis_luaran()
    {
        return $this->hasMany('App\Models\Jenis_luaran', 'jenis_luaran_kategori_id');
    }

    public function status_luaran()
    {
        return $this->hasMany('App\Models\Status_luaran', 'status_luaran_kategori_id');
    }
}
