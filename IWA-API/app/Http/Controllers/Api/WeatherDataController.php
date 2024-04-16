<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WeatherData;

class WeatherDataController extends Controller
{


    public function show($id)
    {
        // Fetch the weather data with the given ID from the database
        $weatherData = WeatherData::find($id);

        // Check if the weather data exists
        if (!$weatherData) {
            return response()->json(['message' => 'Weather data not found'], 404);
        }

        // Return the weather data details as JSON response
        return response()->json(['weather_data' => $weatherData]);
    }
}
