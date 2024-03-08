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

    public function category(){
        return $this->hasMany(Category::class,'kost_id','id');
    }

    public function recomendation(){
        return $this->hasMany(Recomendation::class, 'kost_id','id');
    }
}
