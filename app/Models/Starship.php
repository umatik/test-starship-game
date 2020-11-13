<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Starship extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'Starships';

    protected $fillable = [
        'name', 'troops','group'
    ];
}
