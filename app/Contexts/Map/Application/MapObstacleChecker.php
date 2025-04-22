<?php

namespace App\Contexts\Map\Application;

use App\Contexts\Map\Domain\Map;
use App\Contexts\Shared\Domain\ValueObjects\Coordinates;

class MapObstacleChecker
{
    private Map $map;

    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    public function hasObstacle(Coordinates $position): bool
    {
        return $this->map->hasObstacle($position);
    }
}

