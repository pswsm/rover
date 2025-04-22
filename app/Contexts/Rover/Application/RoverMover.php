<?php

namespace App\Contexts\Rover\Application;

use App\Contexts\Rover\Domain\Rover;

class RoverMover
{
    public function moveForward(Rover $rover): void
    {
        $rover->moveForward();
    }
}
