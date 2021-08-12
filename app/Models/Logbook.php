<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $primaryKey = 'logbook_id';
    public $table = 'logbook';

    protected $fillable = [
        'logbook_penelitian_id',
        'logbook_date',
        'logbook_uraian_kegiatan',
        'logbook_presentase',
    ];

    public function usulan_penelitian()
    {
        return $this->belongsTo('App\Models\Usulan_penelitian', 'logbook_penelitian_id');
    }
}
