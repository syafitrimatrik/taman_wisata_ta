<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class taman_wisata extends Model
{
    use HasFactory;

    protected $table = 'taman_wisata';

    protected $fillable = [
        'users_id',
        'title',
        'rating',
        'jarak',
        'thumbnail',
        'simple_location',
        'excerpt',
        'description',
        'maps',
        'latitude',
        'longitude',
        'price'
    ];
}
