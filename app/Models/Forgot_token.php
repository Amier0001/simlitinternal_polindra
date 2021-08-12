<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forgot_token extends Model
{
    protected $primaryKey = 'forgot_token_id';

    protected $fillable = [
        'forgot_token_user_id',    'forgot_token_user_email',    'forgot_token',    'forgot_token_due_time'
    ];
}
