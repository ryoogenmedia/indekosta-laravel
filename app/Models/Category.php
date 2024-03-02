<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'kost_id',
        'category',
        'persent',
    ];

    public function indekosta()
    {
        return $this->belongsTo(Kost::class, 'kost_id', 'id')->withDefault();
    }
}
