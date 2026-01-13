<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubIndikator extends Model
{
    use HasFactory;

    protected $table = 'sub_indikator';

    protected $fillable = [
        'indikator_id',
        'nama_sub_indikator',
        'bobot_sub_persen',
    ];

    /**
     * Get the indikator that owns the sub indikator.
     */
    public function indikator()
    {
        return $this->belongsTo(Indikator::class);
    }
}
