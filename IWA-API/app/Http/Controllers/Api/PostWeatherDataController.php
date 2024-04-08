<?php

namespace App\Http\Controllers\Api;

use App\Models\WeatherData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;

class PostWeatherDataController extends Controller
{
    function processWeatherData(Request $request) {
        $weatherData = json_decode($request->input('weather_data'), true);

        foreach ($weatherData as $data) {
            WeatherData::create($data);
        }

        return response()->json(['message' => 'Data inserted successfully'], 200);
    }
}
