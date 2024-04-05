<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;

class PostWeatherDataController extends Controller
{
    function processWeatherData(Request $request) {
        $weatherData = json_decode($request->input('WEATHERDATA'), true);

        foreach ($weatherData as $data) {
            WeatherData::create($data);
        }

        return response()->json(['message' => 'Data inserted successfully'], 200);
    }
}
