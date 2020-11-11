<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Models\Starship;

class GameController extends ApiController
{
    public function starships()
    {
        $starships = Starship::all();
        return $this->success($starships);
    }

    public function opponents()
    {
        $starships = Starship::all()->toArray();
        $opponents = [];

        for ($i=0; $i<2; $i++) {
            $index = array_rand($starships, 1);
            array_push($opponents, $starships[$index]);
            array_splice($starships, $index, 1);
        }

        return $this->success($opponents);
    }
}
