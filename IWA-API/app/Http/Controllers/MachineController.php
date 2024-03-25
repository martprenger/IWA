<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MachineController extends Controller
{
    public function show()
    {
        return view('machinePage', ['machines' => $this->getMachines()]);
    }

    public function getMachines()
    {
        $weatherStations = DB::table('geolocation')->limit(10)->get();
        return $weatherStations;
    }
}
