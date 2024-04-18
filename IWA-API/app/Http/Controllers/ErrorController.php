<?php

namespace App\Http\Controllers;

use App\Models\StationError;
use http\Client\Request;
use Illuminate\Support\Facades\Redirect;

class ErrorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('navbar');
    }

    public function show()
    {
        $errors = StationError::orderBy('count', 'desc')
            ->orderBy('created_at', 'asc')
            ->paginate(200);
        return view('wetenschapelijk.station_errors', ['errors' => $errors]);
    }

    public function deleteError(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'error' => 'required',
        ]);

        $error = StationError::where('station_name', $validatedData['name'])->where('error', $validatedData['error'])->first();
        $error->delete();
        return Redirect::route('stationerrors')->with('success', 'Employee deleted successfully.');
    }
}
