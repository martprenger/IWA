<?php

namespace App\Http\Controllers;

use App\Models\Geolocation;
use App\Models\NearestLocation;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('navbar');
    }

    public function show()
    {
        $geolocations = Geolocation::paginate(200);
        return view('station.stations', ['geolocations' => $geolocations]);

    }

    public function addStationShow()
    {
        return view('station.add_station');
    }

    public function addStation(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:10',
            'elevation' => 'required|numeric',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'country_code' => 'required|string|size:2',
            'island' => 'nullable|string',
            'county' => 'nullable|string',
            'place' => 'nullable|string',
            'hamlet' => 'nullable|string',
            'town' => 'nullable|string',
            'municipality' => 'nullable|string',
            'state_district' => 'nullable|string',
            'administrative' => 'nullable|string',
            'state' => 'nullable|string',
            'village' => 'nullable|string',
            'region' => 'nullable|string',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'locality' => 'nullable|string',
            'postcode' => 'nullable|string',
            'localcountryname' => 'nullable|string',
        ]);

        // Create a new Station instance
        $station = Station::create([
            'name' => $validatedData['name'],
            'elevation' => $validatedData['elevation'],
            'longitude' => $validatedData['longitude'],
            'latitude' => $validatedData['latitude'],
        ]);

        // Create a new Geolocation instance
        $geolocation = Geolocation::create([
            'station_name' => $validatedData['name'],
            'country_code' => $validatedData['country_code'],
            'island' => $validatedData['island'],
            'county' => $validatedData['county'],
            'place' => $validatedData['place'],
            'hamlet' => $validatedData['hamlet'],
            'town' => $validatedData['town'],
            'municipality' => $validatedData['municipality'],
            'state_district' => $validatedData['state_district'],
            'administrative' => $validatedData['administrative'],
            'state' => $validatedData['state'],
            'village' => $validatedData['village'],
            'region' => $validatedData['region'],
            'province' => $validatedData['province'],
            'city' => $validatedData['city'],
            'locality' => $validatedData['locality'],
            'postcode' => $validatedData['postcode'],
            'country' => $validatedData['localcountryname'],
            // Add other fields as needed
        ]);

        // Create a new NearestLocation instance
        $nearestLocation = NearestLocation::create([
            'station_name' => $validatedData['name'],
            'name' => $validatedData['name'],
            'country_code' => $validatedData['country_code'],
            'longitude' => $validatedData['longitude'],
            'latitude' => $validatedData['latitude'],
            // Add other fields as needed
        ]);

        // Check if all instances were created successfully
        if ($station && $geolocation && $nearestLocation) {
            return redirect()->route('stations')->with('success', 'Station and related records created successfully.');
        } else {
            // Handle if creation fails
            return redirect()->route('stations')->with('error', 'Failed to create station and related records.');
        }
    }

    public function deleteStation(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        // Find the station with the given name
        NearestLocation::where('station_name', $validatedData['name'])->delete();
        Geolocation::where('station_name', $validatedData['name'])->delete();
        Station::where('name', $validatedData['name'])->delete();
        return Redirect::route('stations')->with('error', 'Station not found.');

    }


    public function editStationShow($name)
    {
        $station = Station::where('name', $name)->first();
        $geolocation = Geolocation::where('station_name', $name)->first();
        $nearestLocation = NearestLocation::where('station_name', $name)->first();

        if ($station && $geolocation && $nearestLocation) {
            return view('station.edit_station', compact('station', 'geolocation', 'nearestLocation'));
        } else {
            return redirect()->route('stations')->with('error', 'Station not found.');
        }
    }

    public function editStation(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:10',
            'elevation' => 'required|numeric',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'country_code' => 'required|string|size:2',
            'island' => 'nullable|string',
            'county' => 'nullable|string',
            'place' => 'nullable|string',
            'hamlet' => 'nullable|string',
            'town' => 'nullable|string',
            'municipality' => 'nullable|string',
            'state_district' => 'nullable|string',
            'administrative' => 'nullable|string',
            'state' => 'nullable|string',
            'village' => 'nullable|string',
            'region' => 'nullable|string',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'locality' => 'nullable|string',
            'postcode' => 'nullable|string',
            'localcountryname' => 'nullable|string',
        ]);

        $station = Station::where('name', $request->old_name)->first();
        $geolocation = Geolocation::where('station_name', $request->old_name)->first();
        $nearestLocation = NearestLocation::where('station_name', $request->old_name)->first();

        if ($station && $geolocation && $nearestLocation) {
            $station->fill($validatedData);
            $geolocation->fill($validatedData);
            $nearestLocation->fill($validatedData);

            $station->save();
            $geolocation->save();
            $nearestLocation->save();

            return redirect()->route('stations')->with('success', 'Station and related records updated successfully.');
        } else {
            return redirect()->route('stations')->with('error', 'Failed to update station and related records.');
        }
    }
}
