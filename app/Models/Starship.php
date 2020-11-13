<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Starship extends Eloquent
{
    use HasFactory;

    //protected $connection = 'mongodb';
    //protected $collection = 'Starships';

    protected $fillable = [
        'name', 'troops','group'
    ];
}
