<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WeatherData;
use App\Models\Klant;

class WeatherDataController extends Controller
{

    public function receiveRequest(Request $request, $id, $station = null) {
        $this->checkApiContractMatch($request, $apiKey, $id);
        $returnData;
        if (isset($station)) {
            if (Station::where('name', $station)->exists()) {
                $returnData = $this->getData($this->getQuery($request, $id), [$station]);
            }
        } else {
            $stations = ContractStations::where('contract_id', $id)->pluck('station')->toArray();
            $returnData = $this->getData($this->getQuery($request, $id), $stations);
        }

        return response()->json($returnData, 200);
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
            if ($key === "value" && WeatherData::isAccesible($val)) {
                if (ContractPermissions::where("contract_id", $contractID)
                        ->where("permissions", $val)
                        ->exists()) 
                {
                    array_push($query, $val);
                } else {
                    response()->json(['message' => 'You dont have access to the '.$key.' field'], 401);
                }
            }
        }
        if (count($query) > 0) {
            return $query;
        }

        return ContractPermissions::where('contract_id', $contractId)->pluck('permissions')->toArray();
    }

    public function checkApiContractMatch($request, $apiKey, $contractID) {
        $this->checkContract($id);
        $this->checkApiKey($request);
        
        $getApiCustomerId = APIkeys::where("APIkey", $apiKey)->value("klantenID");
        $getContractCustomerId = Contracts::where('id', $contractID)->value("customer_id");

        return ($getApiCustomerId == $getContractCustomerId);
    }

    public function checkApiKey($request) {
        $apiKey;
        if ($request->has("api-key")) {
            $apiKey = $request->input("api-key");
        } else {
            return response()->json(['message' => 'No API key provided'], 401);
        }

        if (!APIkeys::where("APIkey", $apiKey)->exists()) {
            return response()->json(['message' => 'Non existant API key provided'], 401);
        }
    }

    public function checkContract($id) {
        if (!Contracts::where("id", $id)->exists()) {
            return response()->json(['message' => 'Non existant contract'], 401);
        }
    }
}
