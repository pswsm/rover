<?php

namespace App\Contexts\Map\Application;

use App\Contexts\Map\Domain\Map;
use App\Contexts\Shared\Domain\ValueObjects\Coordinates;


class MapBoundaryChecker
{
    private Map $map;

    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    public function isWithinBounds(Coordinates $position): bool
    {
        return $this->map->isWithinBounds($position);
    }
}

