<?php

namespace Database\Factories;

use App\Models\Starship;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StarshipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Starship::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
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
