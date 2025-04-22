<?php

use App\Http\Controllers\MissionControlController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function() {
    Route::post('/mission-control', [MissionControlController::class, 'generateMission']);
    Route::get('/mission-control/{id}', [MissionControlController::class, 'getMission']);
    Route::post('/mission-control/{id}/commands', [MissionControlController::class, 'sendCommands']);
});
