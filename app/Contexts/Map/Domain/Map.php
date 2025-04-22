<?php

namespace App\Contexts\Map\Domain;

use App\Contexts\Shared\Domain\ValueObjects\Coordinates;

class Map
{
    private int $size;
    private array $obstacles;

    /**
     * @param array<int,Obstacles> $obstacles
     */
    public function __construct(int $size, array $obstacles = [])
    {
        $this->size = $size;
        $this->obstacles = $obstacles;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return array<int,Obstacles>
     */
    public function getObstacles(): array
    {
        return $this->obstacles;
    }

    public function hasObstacle(Coordinates $position): bool
    {
        foreach ($this->obstacles as $obstacle) {
            if ($obstacle->coordinates_match($position)) {
                return true;
            }
        }
        return false;
    }

    public function isWithinBounds(Coordinates $position): bool
    {
        return $position->getX() >= 0 && $position->getX() < $this->size &&
               $position->getY() >= 0 && $position->getY() < $this->size;
    }
}

