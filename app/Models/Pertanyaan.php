<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan';

    protected $fillable = [
        'sub_indikator_id',
        'n_pertanyaan',
    ];

    /**
     * Get the sub indikator that owns the pertanyaan.
     */
    public function subIndikator()
    {
        return $this->belongsTo(SubIndikator::class);
    }
}
