<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\API\PlaceController;
use App\Http\Controllers\API\WeatherController;
use App\Http\Controllers\API\LocationController;
use App\Services\LocationService;
use App\Services\PlaceService;
use App\Services\WeatherService;
use App\Contracts\ApiServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(LocationController::class)
            ->needs(ApiServiceInterface::class)
            ->give(fn () => new LocationService(config('services.geoapify.key'), config('services.geoapify.url')));

        $this->app->when(PlaceController::class)
            ->needs(ApiServiceInterface::class)
            ->give(fn () => new PlaceService(config('services.foursquare.key'), config('services.foursquare.url')));

        $this->app->when(WeatherController::class)
            ->needs(ApiServiceInterface::class)
            ->give(fn () => new WeatherService(config('services.open_weather.key'), config('services.open_weather.url')));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
