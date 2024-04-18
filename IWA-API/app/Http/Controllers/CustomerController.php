<?php

namespace App\Http\Controllers;

use App\Models\Klant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('navbar');
    }

    public function show()
    {
        return view('administration.addcustomer');
    }

    public function addCostumer(Request $request)
    {
        $validatedData = $request->validate([
            'klantnaam' => 'required|string|max:255',
            'email' => 'required|email|unique:klanten,email',
        ]);

        $customer = new Klant();
        $customer->fill($validatedData);
        $customer->save();

        return Redirect::route('contracten')->with('success', 'Employee added successfully.');
    }
}
