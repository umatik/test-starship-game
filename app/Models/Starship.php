<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Starship extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'Starship';

    protected $fillable = [
        'name', 'troops','group'
    ];
}
