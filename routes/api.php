<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\PlaceController;
use App\Http\Controllers\API\WeatherController;
use App\Http\Controllers\API\LocationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('location', LocationController::class)->middleware(['client']);
Route::get('places', PlaceController::class)->middleware(['client']);
Route::get('weather', WeatherController::class)->middleware(['client']);