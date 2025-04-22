<?php

namespace App\Applications;

class MissionControlFinder
{
    public function __construct(
        private MissionControlRepository $repository
    ) {}

    public function getById(string $id): ?MissionControl
    {
        return $this->repository->getMissionControl($id);
    }
}
