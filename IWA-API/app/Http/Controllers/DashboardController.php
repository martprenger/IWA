<?php

namespace App\Http\Controllers;

use App\Models\Geolocation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('navbar');
        $this->middleware('dashboard');
    }



    public function show(): View
    {
        $geolocations = Geolocation::all();
        return view('dashboard', ['geolocations' => $geolocations]);
    }
}
