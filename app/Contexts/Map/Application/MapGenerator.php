<?php

namespace App\Contexts\Map\Application;

use App\Contexts\Map\Domain\Map;
use App\Contexts\Map\Domain\ValueObjects\Obstacle;
use App\Contexts\Shared\Domain\ValueObjects\Coordinates;

class MapGenerator
{
    public function generateMap(int $mapSize, int $numObstacles): Map
    {
        $obstacles = $this->generateRandomObstacles($mapSize, $numObstacles);
        return new Map($mapSize, $obstacles);
    }

    /**
     * @return Obstacle[]
     */
    private function generateRandomObstacles(int $mapSize, int $numObstacles): array
    {
        $obstacles = [];

        for ($i = 0; $i < $numObstacles; $i++) {
            $x = rand(0, $mapSize - 1);
            $y = rand(0, $mapSize - 1);
            $obstacles[] = new Obstacle(new Coordinates($x, $y));
        }

        return $obstacles;
    }
}

