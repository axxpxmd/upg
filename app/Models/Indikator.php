<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    protected $table = 'indikator';

    protected $fillable = [
        'periode_id',
        'nama_indikator',
        'bobot_persen',
    ];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function subIndikators()
    {
        return $this->hasMany(SubIndikator::class);
    }
}
