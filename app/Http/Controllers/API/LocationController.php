<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\ApiServiceInterface;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    public function __construct(public ApiServiceInterface $locationService) {}

    public function __invoke()
    {
        $locations = config('locations.cities'); 
        
        foreach ($locations as $key => $location) {
            $response[] = $this->locationService
                ->setEndpoint('geocode/search')
                ->setFilter($location)
                ->getData();
        }

        return LocationResource::collection($response);
    }
}
