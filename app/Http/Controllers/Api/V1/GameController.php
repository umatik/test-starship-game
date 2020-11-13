<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Models\Starship;
use App\Models\User;

class GameController extends ApiController
{
    public function starships()
    {
        return $this->success($this->getData());
    }

    public function getData()
    {
        return [
            [
                '_id' => 1,
                'name' => 'Star destroyer',
                'troopers' => rand(1000, 10000),
                'img' => 'star_destroyer'
            ],
            [
                '_id' => 2,
                'name' => 'Borg starship',
                'troopers' => rand(1000, 100000),
                'img' => 'borg'
            ],
            [
                '_id' => 3,
                'name' => 'Enterprise',
                'troopers' => rand(1000, 100000),
                'img' => 'enterprise'
            ],
            [
                '_id' => 4,
                'name' => 'Event Horizon',
                'troopers' => rand(1000, 100000),
                'img' => 'event_horizon'
            ],
            [
                '_id' => 5,
                'name' => 'Nostromo',
                'troopers' => rand(1000, 100000),
                'img' => 'nostromo'
            ],
            [
                '_id' => 6,
                'name' => 'Sulaco',
                'troopers' => rand(1000, 100000),
                'img' => 'sulaco'
            ],
            [
                '_id' => 7,
                'name' => 'Speeder bike',
                'troopers' => 1,
                'img' => 'speeder_bike'
            ],
            [
                '_id' => 8,
                'name' => 'Sanctuary II',
                'troopers' => 1000000000,
                'img' => 'sanctuary2'
            ],
            [
                '_id' => 9,
                'name' => 'Citadel',
                'troopers' => 1000000000,
                'img' => 'citadel'
            ]
        ];
    }
}
