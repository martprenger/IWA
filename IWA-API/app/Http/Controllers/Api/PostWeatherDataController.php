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
                
                // Check for missing data
                $stationID = $data['STN'];
                Log::info('Station id: ' . $stationID);
                $data = $this->insertLostData($stationID, $data);

                // Create a new WeatherData model instance
                $weatherData = new WeatherData();


                // Map JSON fields to database columns
                $weatherData->STN = $stationID;
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

    public function insertLostData($stationID, $data) {
        $newData = array();

        foreach ($data as $key=>$value) {
            if ($value === "None" || $this->checkForValidData($stationID, $key, $value)) { // TODO: This should create an error for the administrive employee
                $newData[$key] = $this->createLostData($stationID, $key);
                Log::info("Inserted new or edited data at key: " . $key . ", With data: " . $newData[$key]);
            } else {
                $newData[$key] = $value;
            }
        }
        return $newData;
    }

    public function createLostData($stationID, $key) {
        $lastEntries = WeatherData::where("STN", $stationID)->orderBy("created_at", "desc")->take(5)->get();
        $newValue = $lastEntries->avg($key);
        return $newValue;
    }

    public function checkForValidData($stationID, $key, $value) {
        $lastEntrie = WeatherData::where("STN", $stationID)->orderBy("created_at", "desc")->take(1)->get();
        return ($value < $lastEntrie[$key] * 1.20) && ($value > $lastEntrie[$key] * 0.80);
    }  
}



