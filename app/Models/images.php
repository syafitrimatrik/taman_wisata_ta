<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'name_image',
        'type_table',
        'relation_id',
    ];
}
