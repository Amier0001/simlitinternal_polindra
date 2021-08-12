<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doc_template extends Model
{
    protected $table = 'doc_template';
    protected $primaryKey = 'doc_template_id';

    protected $fillable = [
        'doc_template_label',
        'doc_template_original_name',
        'doc_template_hash_name',
        'doc_template_base_name',
        'doc_template_size',
        'doc_template_extension',
        'doc_template_date',
    ];
}
