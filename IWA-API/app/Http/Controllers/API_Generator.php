<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class API_Generator extends Controller
{
    public function show()
    {
        return view('administrator.API_generator');
    }
}
