<?php

namespace App\Contexts\Rover\Application;

use App\Contexts\Rover\Domain\Rover;

class RoverTurner
{
    public function turnLeft(Rover $rover): void
    {
        $rover->turnLeft();
    }

    public function turnRight(Rover $rover): void
    {
        $rover->turnRight();
    }
}

