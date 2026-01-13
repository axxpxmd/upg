<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'opd';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'n_opd',
        'alamat',
    ];

    /**
     * Get the users for the OPD.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'opd_id');
    }
}
