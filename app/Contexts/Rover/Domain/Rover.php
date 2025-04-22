<?php

namespace App\Contexts\Rover\Domain;

use App\Contexts\Rover\Domain\ValueObjects\DirectionEnum;
use App\Contexts\Rover\Domain\ValueObjects\PositionValueObject;

class Rover
{
    public function __construct(private PositionValueObject $position, private DirectionEnum $direction)
    {}

    public function getPosition(): PositionValueObject
    {
        return $this->position;
    }

    public function getDirection(): DirectionEnum
    {
        return $this->direction;
    }

    public function setPosition(PositionValueObject $position): void
    {
        $this->position = $position;
    }

    public function setDirection(DirectionEnum $direction): void
    {
        $this->direction = $direction;
    }
}

