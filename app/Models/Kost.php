<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $table = 'kost';

    protected $fillable = [
        'nama_kost',
        'image',
        'alamat',
        'deskripsi',
        'harga',
        'latitude',
        'longitude',
    ];
}
