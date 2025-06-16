<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'patente',
        'marca',
        'modelo',
        'year',
        'kilometraje',
    ];


    // Desactiva el timestamp
    public $timestamps = false;
}
