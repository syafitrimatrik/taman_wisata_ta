<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;

    protected $table = 'comment';

    protected $fillable = [
        'users_id',
        'comment',
        'like',
        'comment_id',
        'taman_wisata_id'
    ];

}
