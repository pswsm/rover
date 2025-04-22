<?php

namespace App\Applications;

use Illuminate\Support\Facades\Log;

class MissionControlRepository
{
    private array $missionControls = [];

    public function __construct()
    {
        Log::info('MissionControlRepository instance created: ' . spl_object_hash($this));
    }
    
    public function createMissionControl(MissionControl $missionControl): void
    {
        Log::debug('createMissionControl called on: ' . spl_object_hash($this));
        Log::debug('Total controls: ' . count($this->missionControls));
        $this->missionControls[$missionControl->getId()] = $missionControl;
    }

    public function getMissionControl(string $id): ?MissionControl
    {
        Log::debug('getMissionControl called on: ' . spl_object_hash($this));
        Log::debug('Mission controls: ' . count($this->missionControls));
        return $this->missionControls[$id] ?? null;
    }

    public function updateMissionControl(MissionControl $missionControl): void
    {
        Log::debug('updateMissionControl called on: ' . spl_object_hash($this));
        $this->missionControls[$missionControl->getId()] = $missionControl;
    }
}
