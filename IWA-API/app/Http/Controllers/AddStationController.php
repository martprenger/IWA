<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;

class AddStationController extends Controller
{
    public function show() {
        return view("machines.add-station");
    }

    public function handleStationData(Request $request) {
        $station = (object)$request->input('station');

        Station::create([
            'name' => $station->name,
            'elevation' => $station->elevation,
            'longitude' => $station->longitude,
            'latitude' => $station->latitude,
        ]);

        return $this->show();
    }
}

