<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'area',
        'usable_area',
        'description',
        'capacity',
        'price',
        'photo',
    ];

}
