<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favourites extends Model
{
    use HasFactory;

    protected $table = 'favourites';

    protected $fillable = [
        'taman_id',
        'user_id',
        'type',
        'kategori',
    ];
}
