<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Starship extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'starships';

    protected $fillable = [
        'name', 'troops','group'
    ];
}
