<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $table = 'bidang_penelitian';
    protected $primaryKey = 'bidang_id';

    protected $fillable = [
        'bidang_label',
    ];
}
