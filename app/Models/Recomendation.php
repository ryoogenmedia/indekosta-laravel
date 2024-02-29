<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendation extends Model
{
    use HasFactory;

    protected $table = 'recomendations';

    protected $fillable = [
        'kost_id',
        'user_id',
        'rating',
        'nama',
        'email',
        'ulasan',
    ];
}
