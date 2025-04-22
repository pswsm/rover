<?php

namespace App\Applications;

use App\Contexts\Map\Application\MapGenerator;
use App\Contexts\Rover\Application\RoverCreator;

class MissionControlCreator
{
    public function __construct(
        private MissionControlRepository $repository,
        private MapGenerator $mapGenerator,
        private RoverCreator $roverCreator
    ) {}

    public function create(int $mapSize, int $numObstacles = 10): MissionControl
    {
        $rover = $this->roverCreator->create();
        $map = $this->mapGenerator->generateMap($mapSize, $numObstacles);
        $missionControl = new MissionControl($this->generateUniqueId(), $map, $rover);

        $this->repository->createMissionControl($missionControl);

        return $missionControl;
    }

    private function generateUniqueId(): string
    {
        return uniqid('mc_', true);
    }
}

