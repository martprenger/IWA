<?php

namespace App\Http\Controllers;

use App\Models\APIkeys;
use App\Models\klant;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('navbar');
    }

    public function show()
    {
        //get list of employees
        $keys = APIkeys::all();

        return view('administration.APIManagement', ['keys' => $keys]);
    }


    public function apitest(){
        $apiKeysWithKlanten = APIkeys::with('klanten')->get();

        // Loop door elke API-key en toon de bijbehorende klanten
        foreach ($apiKeysWithKlanten as $apiKey) {
            echo "API-key: " . $apiKey->APIkey . "\n";
            echo "Klanten: \n";
            foreach ($apiKey->klanten as $klant) {
                echo "- " . $klant->klantnaam . "\n";
            }
        }

        // Voorbeeld: Klant ophalen met bijbehorende API-key
        $klantWithAPI = Klant::with('API')->first();

        // Toon de klantnaam en de bijbehorende API-key
        echo "Klantnaam: " . $klantWithAPI->klantnaam . "\n";
        echo "Bijbehorende API-key: " . $klantWithAPI->API->APIkey . "\n";
    }

}
