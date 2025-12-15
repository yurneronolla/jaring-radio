<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto',
        'nama',
        'alamat',
        'no_telpon',
        'email',
        'nama_organisasi'
    ];
}