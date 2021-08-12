<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota_penelitian extends Model
{
    protected $table = 'anggota_penelitian';
    protected $primaryKey = 'anggota_penelitian_id';

    protected $fillable = [
        'anggota_penelitian_user_id',
        'anggota_penelitian_penelitian_id',
        'anggota_penelitian_role',
        'anggota_penelitian_role_position',
        'anggota_penelitian_tugas',
    ];

    public function usulan_penelitian()
    {
        return $this->belongsTo('App\Models\Usulan_penelitian', 'anggota_penelitian_penelitian_id');
    }
}
