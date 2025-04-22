<?php

namespace App\Contexts\Rover\Domain\ValueObjects;

class PositionValueObject
{
    private int $x;
    private int $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function equals(PositionValueObject $other): bool
    {
        return $this->x === $other->getX() && $this->y === $other->getY();
    }
}

