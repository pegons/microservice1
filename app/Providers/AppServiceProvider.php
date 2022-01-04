<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Microservice\Application\Services\Create\CreateRideServiceApplication;
use Microservice\Application\Services\Create\CreateRideServiceApplicationInterface;
use Microservice\Application\Services\Get\GetRideServiceApplication;
use Microservice\Application\Services\Get\GetRideServiceApplicationInterface;
use Microservice\Application\Services\Update\UpdateRideServiceApplication;
use Microservice\Application\Services\Update\UpdateRideServiceApplicationInterface;
use Microservice\Domain\Repositories\RideServiceRepositoryInterface;
use Microservice\Domain\Repositories\VehicleTypeRepositoryInterface;
use Microservice\Infrastructure\EloquentRideServiceRepository;
use Microservice\Infrastructure\EloquentVehicleTypeRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(RideServiceRepositoryInterface::class, EloquentRideServiceRepository::class);
        $this->app->bind(CreateRideServiceApplicationInterface::class, CreateRideServiceApplication::class);
        $this->app->bind(VehicleTypeRepositoryInterface::class, EloquentVehicleTypeRepository::class);
        $this->app->bind(UpdateRideServiceApplicationInterface::class, UpdateRideServiceApplication::class);
        $this->app->bind(GetRideServiceApplicationInterface::class, GetRideServiceApplication::class);
    }
}
