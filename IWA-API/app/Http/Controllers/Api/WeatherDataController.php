<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WeatherData;
use App\Models\Klant;
use App\Models\Contracten;
use App\Models\PermissionContract;
use App\Models\ContractStation;
use App\Models\APIkeys;

class WeatherDataController extends Controller
{

    public function receiveRequest(Request $request, $id, $station = null) {
        $this->checkApiContractMatch($request, $id);
        $returnData;
        if (isset($station)) {
            if (Station::where('name', $station)->exists()) {
                $returnData = $this->getData($this->getQuery($request, $id), [$station]);
            }
        } else {
            $stations = ContractStation::where('contract_id', $id)->pluck('station')->toArray();
            $returnData = $this->getData($this->getQuery($request, $id), $stations);
        }

        return response()->json($this->getQuery($request, $id), 200);
    }

    public function getData($query, $stations) {
        $returnData = array();
        
        foreach ($stations as $station) {
            $stationSpecificData = array();
            $stationSpecificData["STN"] = $station;
            foreach ($query as $type) {
                $stationSpecificData[$type] = WeatherData::where("STN", $station)->latest()->value($type);
            }
            array_push($returnData, $stationSpecificData);
        }

        return $returnData;
    }
    
    public function getQuery($request, $contractID) {
        $query = array();
        foreach ($request->query() as $key => $val) {
            if ($key == "value" && WeatherData::isAccesible($val)) {
                if (PermissionContract::where("contract_id", $contractID)
                        ->where("permissions", $val)
                        ->exists()) 
                {
                    array_push($query, $val);
                } else {
                    abort(401, 'You dont have access to the '.$key.' field');
                }
            }
        }
        if (count($query) > 0) {
            return $query;
        }

        return PermissionContract::where('contract_id', $contractID)->pluck('permissions')->toArray();
    }

    public function checkApiContractMatch($request, $contractID) {
        $this->checkContract($contractID);
        $apiKey = $this->checkApiKey($request);
        
        $getApiCustomerId = APIkeys::where("APIkey", $apiKey)->value("klantenID");
        $getContractCustomerId = Contracten::where('id', $contractID)->value("customer_id");

        return ($getApiCustomerId == $getContractCustomerId);
    }

    public function checkApiKey($request) {
        $apiKey;
        if ($request->has("api-key")) {
            $apiKey = $request->input("api-key");
        } else {
            abort(401, 'No API key provided');
        }

        if (APIkeys::where("APIkey", $apiKey)->exists()) {
            return $apiKey;
        } else {
            abort(401, 'Non existant API key provided');
        }
    }

    public function checkContract($id) {
        if (!Contracten::where("id", $id)->exists()) {
            abort(401, 'Non existant contract');
        }
    }
}
