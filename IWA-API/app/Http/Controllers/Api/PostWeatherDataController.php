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
                $weatherData->STN = $data['STN'] ?? null;
                $weatherData->DATE = $data['DATE'] ?? null;
                $weatherData->TIME = $data['TIME'] ?? null;
                $weatherData->TEMP = $data['TEMP'] ?? null;
                $weatherData->DEWP = $data['DEWP'] ?? null;
                $weatherData->STP = $data['STP'] ?? null;
                $weatherData->SLP = $data['SLP'] ?? null;
                $weatherData->VISIB = $data['VISIB'] ?? null;
                $weatherData->WDSP = $data['WDSP'] ?? null;
                $weatherData->PRCP = $data['PRCP'] ?? null;
                $weatherData->SNDP = $data['SNDP'] ?? null;
                $weatherData->FRSHTT = $data['FRSHTT'] ?? null;
                $weatherData->CLDC = $data['CLDC'] ?? null;
                $weatherData->WNDDIR = $data['WNDDIR'] ?? null;

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



