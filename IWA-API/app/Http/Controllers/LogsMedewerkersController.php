<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogsMedewerkersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('navbar');
    }

    public function show()
    {
        return view('admin.logs');
    }
}
