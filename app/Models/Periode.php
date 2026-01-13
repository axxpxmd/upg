<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'periode';

    protected $fillable = [
        'tahun',
        'tgl_mulai',
        'tgl_selesai',
        'is_active',
    ];

    public function indikators()
    {
        return $this->hasMany(Indikator::class);
    }
}
