<?php

namespace App\Http\Controllers\Api;

use App\Models\StationError;
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

            $stationID = null;

            // Iterate over each weather data record
            foreach ($jsonData as $data) {

                // Check for missing data
                $stationID = $data['STN'];

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
            }

            return response()->json(['message' => 'Data inserted successfully'], 201);
        } catch (\Exception $e) {
            // Log error
            Log::error('Error processing weather data: ' . $e->getMessage() . "\n" . $e->getTraceAsString());

            return response()->json(['message' => 'An error occurred while processing the data: ' . $e->getMessage()], 500);
        }
    }

    public function insertLostData($stationID, $data) {
        $newData = array();

        foreach ($data as $key=>$value) {
            if ($value == "None" || !$this->checkForValidData($stationID, $key, $value)) { // TODO: This should create an error for the administrive employee
                $newData[$key] = $this->createLostData($stationID, $key);
                $errorType = $value == "None" ? 'no value' : 'no valid data';

                $stationError = StationError::where('station_name', $stationID)
                    ->where('error', $errorType)
                    ->first();

                if ($stationError) {
                    // If the station already has this error, increment the count
                    $stationError->increment('count');
                } else {
                    // If the station does not have this error, create a new StationError
                    StationError::create([
                        'station_name' => $stationID,
                        'error' => $errorType,
                        'count' => 1
                    ]);
                }
            } else {
                $newData[$key] = $value;
            }
        }
        return $newData;
    }

    public function createLostData($stationID, $key) {
        $lastEntries = WeatherData::where("STN", $stationID)->orderBy("created_at", "desc")->take(5)->get();
        if ($lastEntries->count() === 0) { // TODO: Raise error for immediate faulty reading within first 5 operations of the weather station.
            $stationError = StationError::where('station_name', $stationID)
                ->where('error_key', 'Immediate faulty reading')
                ->first();

            if ($stationError) {
                // If the station already has this error, increment the count
                $stationError->increment('count');
            } else {
                // If the station does not have this error, create a new StationError
                StationError::create([
                    'station_name' => $stationID,
                    'error' => 'Immediate faulty reading',
                    'count' => 1
                ]);
            }
            return 0;
        }
        $newValue = $lastEntries->avg($key);
        return $newValue;
    }

    public function checkForValidData($stationID, $key, $value) {
        if (!WeatherData::isNumericType($key)) {
            return true;
        }
        $lastEntrie = WeatherData::where("STN", $stationID)->orderBy("created_at", "desc")->first();
        if ($lastEntrie === null) {
            return true;
        }
        return ($value < $lastEntrie[$key] * 1.20) && ($value > $lastEntrie[$key] * 0.80);
    }
}



