<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Models\Starship;
use Exception;

class GameController extends ApiController
{
    public function starships() {
        $starships = Starship::all()->random(2);
        return $this->success($starships);
    }
}
