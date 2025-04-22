<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return Inertia::render('MissionControl', []);
    });
});
