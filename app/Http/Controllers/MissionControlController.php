<?php

namespace App\Http\Controllers;

use App\Applications\MissionControlCreator;
use App\Applications\MissionControlFinder;
use App\Applications\MissionControlUpdater;
use App\Contexts\Map\Domain\ValueObjects\Obstacle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MissionControlController extends Controller
{

    public function __construct(
        private MissionControlCreator $creator,
        private MissionControlFinder $finder,
        private MissionControlUpdater $updater
    )
    {}

    public function generateMission(Request $request): JsonResponse
    {
        // $mapSize = $request->input('map_size', 200);
        // $obstacles = $request->input('obstacle_number', 15);

        $missionControl = $this->creator->create(25, 5);

        return response()->json([
            'id' => $missionControl->getId(),
            'map' => [
                'size' => $missionControl->getMap()->getSize(),
                'obstacles' => array_map(fn(Obstacle $obstacle) => [$obstacle->getX(), $obstacle->getY()], $missionControl->getMap()->getObstacles()),
            ],
            'rover' => [
                'position' => [
                    'x' => $missionControl->getRover()->getPosition()->getX(),
                    'y' => $missionControl->getRover()->getPosition()->getY(),
                ],
                'direction' => $missionControl->getRover()->getDirection()->value,
            ],
        ]);
    }
}

