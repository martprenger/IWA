<?php

namespace App\Http\Controllers\Api;

use App\Models\WeatherData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;

class PostWeatherDataController extends Controller
{
    public function processWeatherData(Request $request)
    {
        try {
            $jsonData = $request->input('WEATHERDATA');
            Log::info('Received JSON data: ' . json_encode($jsonData));

            // Iterate over each weather data record
            foreach ($jsonData as $data) {
                // Log the current data being processed
                Log::info('Processing data: ' . json_encode($data));

                // Create a new WeatherData model instance
                $weatherData = new WeatherData();

                // Map JSON fields to database columns
                $weatherData->STN = $data['STN'];
                $weatherData->DATE = $data['DATE'];
                $weatherData->TIME = $data['TIME'];
                $weatherData->TEMP = $data['TEMP'];
                $weatherData->DEWP = $data['DEWP'];
                $weatherData->STP = $data['STP'];
                $weatherData->SLP = $data['SLP'];
                $weatherData->VISIB = $data['VISIB'];
                $weatherData->WDSP = $data['WDSP'];
                $weatherData->PRCP = $data['PRCP'];
                $weatherData->SNDP = $data['SNDP'];
                $weatherData->FRSHTT = $data['FRSHTT'];
                $weatherData->CLDC = $data['CLDC'];
                $weatherData->WNDDIR = $data['WNDDIR'];

                // Save the model instance
                $weatherData->save();

                // Log successful insertion
                Log::info('Weather data inserted successfully: ' . json_encode($data));
            }

            return response()->json(['message' => 'Data inserted successfully'], 201);
        } catch (\Exception $e) {
            // Log error
            Log::error('Error processing weather data: ' . $e->getMessage());

            return response()->json(['message' => 'An error occurred while processing the data: ' . $e->getMessage()], 500);
        }
    }
}



