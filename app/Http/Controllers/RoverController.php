<?php

namespace App\Http\Controllers;

use App\Contexts\Map\Application\MapBoundaryChecker;
use App\Contexts\Map\Application\MapGenerator;
use App\Contexts\Map\Application\MapObstacleChecker;
use App\Contexts\Rover\Application\RoverMover;
use App\Contexts\Rover\Application\RoverTurner;
use App\Contexts\Rover\Domain\Rover;
use App\Contexts\Rover\Domain\ValueObjects\DirectionEnum;
use App\Domain\Services\MissionControl;
use App\contexts\rover\domain\value\PositionValueObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoverController extends Controller
{
    public function executeCommands(Request $request): JsonResponse
    {
        $x = $request->input('x');
        $y = $request->input('y');
        $direction = DirectionEnum::from($request->input('direction'));
        $commands = $request->input('commands');
        $obstacles = $request->input('obstacles', []);
        $mapSize = $request->input('map_size', 200); // Default map size is 200x200

        $position = new PositionValueObject($x, $y);
        $rover = new Rover($position, $direction);

        $mapGenerator = new MapGenerator();
        $map = $mapGenerator->generateMap($mapSize, $obstacles);

        $roverMover = new RoverMover();
        $roverTurner = new RoverTurner();
        $mapObstacleChecker = new MapObstacleChecker($map);
        $mapBoundaryChecker = new MapBoundaryChecker($map);

        $missionControl = new MissionControl(
            $map,
            $rover,
            $roverMover,
            $roverTurner,
            $mapObstacleChecker,
            $mapBoundaryChecker
        );

        try {
            $missionControl->executeMission($commands);
            return response()->json([
                'position' => [
                    'x' => $missionControl->getRoverPosition()->getX(),
                    'y' => $missionControl->getRoverPosition()->getY(),
                ],
                'direction' => $missionControl->getRoverDirection(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}

