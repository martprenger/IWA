<?php

namespace App\Http\Controllers;

use App\Models\Contracten;
use App\Models\ContractStation;
use App\Models\Country;
use App\Models\Geolocation;
use App\Models\Klant;
use App\Models\PermissionContract;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ContractController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('navbar');
    }

    public function show(Request $request)
    {
        $post = $request->all();

        $query = Contracten::query();

        if (!empty($post['id'])) {
            $query->where('id', $post['id']);
        }

        if (!empty($post['klantenNaam'])) {
            $klantId = Klant::where('klantnaam', $post['klantenNaam'])->first()->id;
            if ($klantId) {
                $query->where('customer_id', $klantId);
            }
        }

        if (!empty($post['aantalstations'])) {
            $stations = ContractStation::select('contract_id')
                ->selectRaw('count(*) as aantal')
                ->groupBy('contract_id')
                ->having('aantal', $post['aantalstations'])
                ->get();

            $contractIds = $stations->pluck('contract_id');
            $query->whereIn('id', $contractIds);
        }

        if (!empty($post['aantalpermisions'])) {
            $permissions = PermissionContract::select('contract_id')
                ->selectRaw('count(*) as aantal')
                ->groupBy('contract_id')
                ->having('aantal', $post['aantalpermisions'])
                ->get();

            $contractIds = $permissions->pluck('contract_id');
            $query->whereIn('id', $contractIds);
        }

        $contracten = $query->get();

        return view('administration.contract', ['contracten' => $contracten]);
    }


    public function deleteContract(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
        ]);

        $contract = Contracten::find($validatedData['id']);
        $contract->delete();

        return Redirect::route('contracten')->with('success', 'API deleted successfully.');
    }

    public function addContractShow()
    {
        return view('administration.addcontract');
    }

    public function addContract(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'expiration_date' => 'required',
            'polygonCoords' => 'json',
            'permissionsA' => 'array',
            'stations' => 'array',
        ]);

        $contract = new Contracten();
        $contract->fill($validatedData);
        $contract->save();

        $contractId = $contract->id;

        $this->permisionContract($contractId, $validatedData);

        $this->stationContract($contractId, $validatedData);

        #TODO: make notification work and make redirect better
        return Redirect::route('contracten')->with('success', 'API added successfully.');
    }

    public function editContractShow($id)
    {
        $contract = Contracten::find($id);
        return view('administration.editcontract', ['contract' => $contract]);
    }

    public function editContract(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'customer_id' => 'required',
            'expiration_date' => 'required',
            'polygonCoords' => 'json',
            'permissionsA' => 'array',
            'stations' => 'array',
        ]);

        #update existing contract
        $contract = Contracten::find($validatedData['id']);
        $contract->fill($validatedData);
        $contract->save();

        $contractId = $contract->id;

        $this->permisionContract($contractId, $validatedData);

        $this->stationContract($contractId, $validatedData);

        return Redirect::route('contracten')->with('success', 'Employee edited successfully.');
    }

    public function permisionContract($contractId, $validatedData)
    {
        #update all permisions
        PermissionContract::where('contract_id', $contractId)->delete();
        if (isset($validatedData['permissionsA'])) {
            foreach ($validatedData['permissionsA'] as $permission) {
                $contractPermission = new PermissionContract();
                $contractPermission->contract_id = $contractId;
                $contractPermission->permissions = $permission;
                $contractPermission->save();
            }
        }
    }

    public function stationContract($contractId, $validatedData)
    {
        #update stations
        ContractStation::where('contract_id', $contractId)->delete();
        $stations = [];

        if (isset($validatedData['polygonCoords'])) {
            $polygonCoords = $validatedData['polygonCoords'];
            $polygonArray = json_decode($polygonCoords, true);

            // Now $polygonCoordsArray contains an array of polygon coordinates
            foreach ($polygonArray as $polygonCoordsArray) {
                $formattedPolygonCoords = [];
                foreach ($polygonCoordsArray as $coords) {
                    $formattedPolygonCoords[] = implode(' ', $coords);
                }
                $formattedPolygonCoords[] = implode(' ', $polygonCoordsArray[0]);
                $polygonString = implode(',', $formattedPolygonCoords);


                $query = "
                    SELECT *
                    FROM station
                    WHERE ST_Within(location, ST_PolygonFromText('POLYGON(($polygonString))'))
                   ";

                $stationsWithinPolygon = DB::select($query);

                foreach ($stationsWithinPolygon as $station) {
                    $stations[] = $station;
                }
            }
        }

        $matchingGeolocations = collect();

        if (isset($validatedData['stations'])) {
            foreach ($validatedData['stations'] as $option => $fields) {
                foreach ($fields as $input) {
                    $geolocations = collect();
                    if (strpos($option, 'countryName.country') === 0) {
                        $country = Country::where('country', $input)->first();
                        // If the country doesn't exist, return an empty collection
                        if ($country) {
                            $geolocations = Geolocation::where('country_code', $country->country_code)->get();
                        }
                    } else {
                        // No nested relationships, directly query the field
                        $geolocations = Geolocation::where($option, $input)->get();
                    }
                    // Merge the retrieved geolocations into the collection
                    $matchingGeolocations = $matchingGeolocations->merge($geolocations);
                }
            }
        }

        foreach ($matchingGeolocations as $geolocation) {
            $stations[] = $geolocation->station;
        }

        foreach ($stations as $station) {
            // Check if the station already exists in the database
            $existingStation = ContractStation::where('contract_id', $contractId)
                ->where('station', $station->name)
                ->first();

            // If the station doesn't exist, create a new entry
            if (!$existingStation) {
                $contractStation = new ContractStation();
                $contractStation->contract_id = $contractId;
                $contractStation->station = $station->name;
                $contractStation->save();
            }
        }
    }
}
