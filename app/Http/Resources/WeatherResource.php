<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class WeatherResource extends JsonResource
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
            'id' => collect($this->weather)->transform(fn($weather) => $weather->id),
            'temperature' => $this->main->temp . ' °C',
            'humidity' => $this->main->humidity . '%',
            'pressure' => $this->main->pressure,
            'sea_level' => $this->main->sea_level,
            'temp_min' => $this->main->temp_min . ' °C',
            'temp_max' => $this->main->temp_max . ' °C',
            'wind_speed' => $this->wind->speed . ' km/h',
            'time' => Carbon::createFromTimestamp($this->dt)->format('h:i A'),
            'day' => Carbon::createFromTimestamp($this->dt)->format('D'),
            'description' => collect($this->weather)->map(fn($weather) => ucfirst($weather->description)),
            'icon' =>  collect($this->weather)->transform(fn($weather) => config('services.open_weather.icon_url') . '/' . $weather->icon. '.png'),
        ];
    }
}
