<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class simple_location extends Model
{
    use HasFactory;
    
    protected $table = 'simple_location';

    protected $fillable = [
        'name_location'
    ];
}
