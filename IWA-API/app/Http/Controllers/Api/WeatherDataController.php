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
use App\Models\Station;

class WeatherDataController extends Controller
{

    public function receiveRequest(Request $request, $id, $station = null) {
        if (!$this->checkApiContractMatch($request, $id)) {
            abort(401, 'API key doesnt match contract');
        }
        $returnData;
        $count = $this->getCount($request);
        $start = $this->getStartDate($request);
        $end = $this->getEndDate($request);
        if (isset($station)) {
            if (Station::where('name', $station)->exists()) {
                $returnData = $this->getData($this->getQuery($request, $id), [$station], $count, $start, $end);
            }
        } else {
            $stations = ContractStation::where('contract_id', $id)->pluck('station')->toArray();
            $returnData = $this->getData($this->getQuery($request, $id), $stations, $count, $start, $end);
        }

        return response()->json($returnData, 200);
    }

    public function getStartDate($request) {
        if ($request->has("start")) {
            return $request->input("start");
        } else {
            return null;
        }
    }

    public function getEndDate($request) {
        if ($request->has("end")) {
            return $request->input("end");
        } else {
            return null;
        }
    }

    public function getCount($request) {
        if ($request->has("count")) {
            return (int) $request->input("count");
        } else {
            return -1;
        }
    }

    public function getData($query, $stations, $count, $start = null, $end = null) {
        $returnData = array();

        foreach ($stations as $station) {
            $queryBuilder = WeatherData::query();
            if ($count != -1) {
                $queryBuilder->select($query)->where("STN", $station)->latest()->take($count);
            } else {
                $queryBuilder->select($query)->where("STN", $station);
            }


            if ($start && $end) {
                $startDate = date("Y-m-d", strtotime($start));
                $endDate = date("Y-m-d", strtotime($end));
                $startTime = date("H:i:s", strtotime($start));
                $endTime = date("H:i:s", strtotime($end));
                $queryBuilder->whereDate("DATE", ">=", $startDate)
                    ->whereDate("DATE", "<=", $endDate);

                $queryBuilder->whereDate("DATE", '=', $startDate)
                    ->whereTime("TIME", ">=", $startTime);

                $queryBuilder->whereDate("DATE", '=', $endDate)
                    ->whereTime("TIME", "<=", $endTime);
            }

            $stationCords = Station::query()->select("longitude", "latitude")->where("name", $station)->get()[0];
            $stationSpecificData = array(
                "STN" => $station,
                "LONG" => $stationCords->longitude,
                "LAT" => $stationCords->latitude,
                "DATA" => $queryBuilder->get()
            );
            array_push($returnData, $stationSpecificData);
        }

        return $returnData;
    }

    public function getQuery($request, $contractID) {
        $query = array();
        $values = explode(",", $request->query('value'));
        foreach ($values as $val) {
            if (WeatherData::isAccesible($val)) {
                if (PermissionContract::where("contract_id", $contractID)
                        ->where("permissions", $val)
                        ->exists())
                {
                    array_push($query, $val);
                } else {
                    abort(401, 'You dont have access to the '.$val.' field');
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
