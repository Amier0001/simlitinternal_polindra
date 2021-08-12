<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unlock_feature extends Model
{
    protected $table = 'unlock_feature';
    protected $primaryKey = 'unlock_feature_id';

    protected $fillable = [
        'unlock_feature_name',
        'unlock_feature_start_year',
        'unlock_feature_end_year',
        'unlock_feature_start_time',
        'unlock_feature_end_time',
    ];
}
