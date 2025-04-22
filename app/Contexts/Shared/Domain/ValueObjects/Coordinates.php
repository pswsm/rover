<?php

namespace App\Contexts\Shared\Domain\ValueObjects;

class Coordinates
{
    public function __construct(
        private int $x,
        private int $y
    )
    {}

    public function getX(): int {
        return $this->x;
    }

    public function getY(): int {
        return $this->y;
    }

    public function equals(self $other): bool {
        return $this->x == $other->getX() && $this->y == $other->getY();
    }
}
