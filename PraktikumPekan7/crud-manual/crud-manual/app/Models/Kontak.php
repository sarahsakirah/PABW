<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontaks'; // Menghubungkan ke tabel kontaks

    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'foto',
    ];
}