<?php

namespace App\Providers;

use App\Applications\MissionControlRepository;
use Illuminate\Support\ServiceProvider;

class MissionControlRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(MissionControlRepository::class, function ($app) {
            return new MissionControlRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
