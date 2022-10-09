<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\ApiServiceInterface;
use App\Http\Resources\WeatherResource;

class WeatherController extends Controller
{
    public function __construct(public ApiServiceInterface $weatherService) {}

    public function __invoke()
    {
        $response = $this->weatherService
            ->setEndpoint('forecast')
            ->setFilter(request()->query())
            ->getData();

        return collect(WeatherResource::collection($response))->groupBy('time')->values();
    }
}
