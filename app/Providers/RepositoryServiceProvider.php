<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\TrackingRepositoryContract;
use App\Repositories\TrackingRepository;
use App\Repositories\Contracts\AuthRepositoryContract;
use App\Repositories\AuthRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TrackingRepositoryContract::class, TrackingRepository::class);
        $this->app->singleton(AuthRepositoryContract::class, AuthRepository::class);
    }
}
