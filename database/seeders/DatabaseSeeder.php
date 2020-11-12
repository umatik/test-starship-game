<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('Starship')->delete();

        $starships = $this->starshipList();
        foreach ($starships as $starship) {
            DB::collection('Starship')->insert($starship);
        }

    }

    private function starshipList() : array
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
                'troopers' => 2000000000,
                'img' => 'citadel'
            ]
        ];
    }
}
