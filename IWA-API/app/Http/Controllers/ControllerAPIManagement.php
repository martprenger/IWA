<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerAPIManagement extends Controller
{
    public function show()
    {
        return view('administration.APIManagement');
    }
}
