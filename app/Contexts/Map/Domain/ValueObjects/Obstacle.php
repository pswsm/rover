<?php

namespace App\Contexts\Map\Domain\ValueObjects;

use App\Contexts\Shared\Domain\ValueObjects\Coordinates;

class Obstacle
{
    public function __construct(private Coordinates $coordinates)
    {}

    public function getX(): int {
        return $this->coordinates->getX();
    }

    public function getY(): int {
        return $this->coordinates->getY();
    }

    public function equals(self $other): bool {
        return $this->coordinates->equals($other);
    }

    public function coordinates_match(Coordinates $other): bool {
        return $this->coordinates->equals($other);
    }
}
