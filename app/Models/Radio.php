<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radio extends Model
{
    use HasFactory;

    protected $fillable = [
        'provinsi_id',
        'foto',
        'nama',
        'alamat',
        'no_telpon',
        'email',
        'nama_radio'
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
}