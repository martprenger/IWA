<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContractController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('navbar');
    }

    public function show()
    {
        return view('administration.contract');
    }
}
