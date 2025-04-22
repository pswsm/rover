<?php

namespace App\Applications;

class MissionControlUpdater
{
    public function __construct(
        private MissionControlRepository $repo
    ) {}

    public function update(MissionControl $missionControl): void {
        $this->repo->updateMissionControl($missionControl);
    }
}
