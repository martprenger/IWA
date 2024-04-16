<?php

namespace App\Http\Controllers;

use App\Models\APIkeys;
use App\Models\klant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class APIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('navbar');
    }

    public function show(Request $request)
    {
        $post = $request->all();

        // Start a query
        $query = APIkeys::query();

        // If an ID is provided, filter by ID
        if (!empty($post['id'])) {
            $query->where('id', 'like', '%' . $post['id'] . '%');
        }


        if (!empty($post['APIkey'])) {
            $query->where('APIkey', 'like', '%' . $post['APIkey'] . '%');
        }

        if (!empty($post['status'])) {
            $query->where('actief', 'like', '%' . $post['status'] . '%');
        }

        if (!empty($post['start_date'])) {
            $query->whereDate('created_at', '>', $post['start_date']);
        }

        if (!empty($post['end_date'])) {
            $query->whereDate('created_at', '<', $post['end_date']);
        }

        $keys = $query->get();

        return view('administration.APIManagement', ['keys' => $keys]);
    }

    public function deleteAPI(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
        ]);

        $user = APIkeys::find($validatedData['id']);
        $user->delete();

        return Redirect::route('APIManagement')->with('success', 'API deleted successfully.');
    }

    public function addAPIkeyShow(){
        return view('administration.addAPIkey');
    }
    public function addAPIkey(Request $request){
        $validatedData = $request->validate([
            'klantenID' => 'required',
            'actief' => 'required|boolean',
        ]);

        do {
            $apiKey = Str::random(32);
        } while (APIkeys::where('APIkey', $apiKey)->exists());

        $validatedData['APIkey'] = $apiKey;

        $user = new APIkeys();
        $user->fill($validatedData);
        $user->save();

        #TODO: make notification work and make redirect better
        return Redirect::route('APIManagement')->with('success', 'API added successfully.');
    }

    public function editAPIShow($id)
    {
        $key = APIkeys::find($id);
        return view('administration.editAPIkey', ['key' => $key]);
    }

    public function editAPI(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'klantenID' => 'required',
            'newKey' => 'required|boolean',
            'actief' => 'required|boolean',

        ]);

        if ($validatedData['newKey'] == '1') {
            do {
                $apiKey = Str::random(32);
            } while (APIkeys::where('APIkey', $apiKey)->exists());

            $validatedData['APIkey'] = $apiKey;
        }


        #update existing employee
        $key = APIkeys::find($validatedData['id']);
        $key->fill($validatedData);
        $key->save();
        return Redirect::route('APIManagement')->with('success', 'Employee edited successfully.');
    }

}
