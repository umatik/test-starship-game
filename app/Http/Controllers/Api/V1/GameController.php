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
                'name' => 'Star destroyer',
                'troopers' => rand(1000, 10000),
                'img' => 'star_destroyer'
            ],
            [
                'name' => 'Borg starship',
                'troopers' => rand(1000, 100000),
                'img' => 'borg'
            ],
            [
                'name' => 'Enterprise',
                'troopers' => rand(1000, 100000),
                'img' => 'enterprise'
            ],
            [
                'name' => 'Event Horizon',
                'troopers' => rand(1000, 100000),
                'img' => 'event_horizon'
            ],
            [
                'name' => 'Nostromo',
                'troopers' => rand(1000, 100000),
                'img' => 'nostromo'
            ],
            [
                'name' => 'Sulaco',
                'troopers' => rand(1000, 100000),
                'img' => 'sulaco'
            ],
            [
                'name' => 'Speeder bike',
                'troopers' => 1,
                'img' => 'speeder_bike'
            ],
            [
                'name' => 'Sanctuary II',
                'troopers' => 1000000000,
                'img' => 'sanctuary2'
            ],
            [
                'name' => 'Citadel',
                'troopers' => 1000000000,
                'img' => 'citadel'
            ]
        ];
    }
}
