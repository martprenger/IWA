<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddMachineController extends Controller
{
    public function show()
    {
        return view('machines.addmachines');
    }
}
