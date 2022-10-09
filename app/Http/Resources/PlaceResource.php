<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'timezone' => $this->timezone,
            'city' => $this->location->locality ?? '',
            'country' => $this->location->country,
            'latitude' => $this->geocodes->main->latitude,
            'longitude' => $this->geocodes->main->longitude,
            'categories' => collect($this->categories)->transform(fn($category) => [
                'icon' => $category->icon->prefix . "bg_100" . $category->icon->suffix,
                'name' => $category->name,
            ]),
        ];
    }
}
