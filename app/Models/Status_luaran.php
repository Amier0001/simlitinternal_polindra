<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status_luaran extends Model
{
    protected $table = 'status_luaran';
    protected $primaryKey = 'status_luaran_id';

    protected $fillable = [
        'status_luaran_kategori_id',
        'status_luaran_label',
    ];

    public function kategori_luaran()
    {
        return $this->belongsTo('App\Models\Kategori_luaran', 'status_luaran_kategori_id');
    }
}
