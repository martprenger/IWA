<?php

use App\Http\Controllers\Api\WeatherDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PostWeatherDataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/postWeatherData', [PostWeatherDataController::class, "processWeatherData"]);


Route::get('/contracten/{id}/all', [WeatherDataController::class, 'receiveRequest'])->where('id', '[0-9]+'); // Get all data associated with the contract
Route::get('/contracten/{id}/{station}', [WeatherDataController::class, 'receiveRequest'])->where(['id' => '[0-9]+', 'station' => '[0-9]+']); // Get all data from specified station
