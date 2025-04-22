<?php

namespace App\Applications;

use App\Contexts\Map\Application\MapBoundaryChecker;
use App\Contexts\Map\Application\MapObstacleChecker;
use App\Contexts\Map\Domain\Map;
use App\Contexts\Rover\Application\RoverMover;
use App\Contexts\Rover\Application\RoverTurner;
use App\Contexts\Rover\Domain\Rover;
use App\contexts\rover\domain\value\PositionValueObject;


class MissionControl
{
    private string $id;
    private Map $map;
    private Rover $rover;

    public function __construct(
        string $id,
        Map $map,
        Rover $rover
    ) {
        $this->id = $id;
        $this->map = $map;
        $this->rover = $rover;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMap(): Map
    {
        return $this->map;
    }

    public function getRover(): Rover
    {
        return $this->rover;
    }

    public function executeMission(
        string $commands,
        MapBoundaryChecker $boundaryChecker,
        MapObstacleChecker $obstacleChecker,
        RoverTurner $turner,
        RoverMover $mover
    ): void
    {
        foreach (str_split($commands) as $command) {
            switch ($command) {
                case 'F':
                    $newPosition = $mover->moveForward($this->rover);
                    if (!$boundaryChecker->isWithinBounds($newPosition)) {
                        throw new \Exception('Out of bounds at ' . $newPosition->getX() . ',' . $newPosition->getY());
                    }
                    if ($obstacleChecker->hasObstacle($newPosition)) {
                        throw new \Exception('Obstacle detected at ' . $newPosition->getX() . ',' . $newPosition->getY());
                    }
                    break;
                case 'L':
                    $turner->turnLeft($this->rover);
                    break;
                case 'R':
                    $turner->turnRight($this->rover);
                    break;
            }
        }
    }

    public function getRoverPosition(): PositionValueObject
    {
        return $this->rover->getPosition();
    }

    public function getRoverDirection(): string
    {
        return $this->rover->getDirection()->value;
    }
}

