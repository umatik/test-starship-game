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
//        DB::collection('Starship')->delete();

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
                'troopers' => rand(100, 10000),
                'group' => 'Empire'
            ],
            [
                'name' => 'Star Mega destroyer',
                'troopers' => rand(100, 10000),
                'group' => 'Empire'
            ]
        ];
    }
}
