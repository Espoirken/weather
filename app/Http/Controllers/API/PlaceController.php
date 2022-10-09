<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\ApiServiceInterface;
use App\Http\Resources\PlaceResource;

class PlaceController extends Controller
{
    public function __construct(public ApiServiceInterface $placeService) {}

    public function __invoke()
    {
        $response = $this->placeService
            ->setEndpoint('places/search')
            ->setFilter(request()->query())
            ->getData();

        return PlaceResource::collection($response);
    }
}
