<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;

class PostWeatherDataController extends Controller
{
    function processWeatherData(Request $request) {
        return response()->json(['message' => "Record updated."]);
    }
}
