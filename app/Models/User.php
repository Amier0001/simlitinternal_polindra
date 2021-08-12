<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_nidn',
        'user_email',
        'user_password',
        'user_role',
        'user_ban',
        'user_active',
        'user_image'
    ];

    public function biodata()
    {
        return $this->hasOne('App\Models\Biodata', 'biodata_user_id');
    }
}
