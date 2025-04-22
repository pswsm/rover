<?php

namespace App\Contexts\Rover\Application;

use App\Contexts\Rover\Domain\Rover;
use App\Contexts\Rover\Domain\ValueObjects\DirectionEnum;
use App\Contexts\Rover\Domain\ValueObjects\PositionValueObject;

class RoverCreator
{
    public function create(): Rover
    {
        return new Rover(
            new PositionValueObject(0, 0),
            DirectionEnum::N
        );
    }
}
