<?php

namespace App\Http\Controllers;

use App\Models\Contracten;
use App\Models\PermissionContract;
use Illuminate\Http\Request;
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

        // Start a query
        $query = Contracten::query();

        // If an ID is provided, filter by ID
        if (!empty($post['id'])) {
            $query->where('id', 'like', '%' . $post['id'] . '%');
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

    public function addContractShow(){
        return view('administration.addcontract');
    }
    public function addContract(Request $request){
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'expiration_date' => 'required',
            'permissionsA' => 'array',
        ]);

        $contract = new Contracten();
        $contract->fill($validatedData);
        $contract->save();

        $contractId = $contract->id;

        foreach ($validatedData['permissionsA'] as $permission) {
            $contractPermission = new PermissionContract();
            $contractPermission->contract_id = $contractId;
            $contractPermission->permissions = $permission;
            $contractPermission->save();
        }
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
            'klantenID' => 'required',
            'newKey' => 'required|boolean',
            'actief' => 'required|boolean',

        ]);


        #update existing employee
        $contract = Contracten::find($validatedData['id']);
        $contract->fill($validatedData);
        $contract->save();
        return Redirect::route('contracten')->with('success', 'Employee edited successfully.');
    }

    public function locationstations(){
        $initialMarkers = [
            [
                'position' => [
                    'lat' => 28.625485,
                    'lng' => 79.821091
                ],
                'label' => [ 'color' => 'white', 'text' => 'P1' ],
                'draggable' => true
            ],
            [
                'position' => [
                    'lat' => 28.625293,
                    'lng' => 79.817926
                ],
                'label' => [ 'color' => 'white', 'text' => 'P2' ],
                'draggable' => false
            ],
            [
                'position' => [
                    'lat' => 28.625182,
                    'lng' => 79.81464
                ],
                'label' => [ 'color' => 'white', 'text' => 'P3' ],
                'draggable' => true
            ]
        ];
        return view('administration.locationStation', ['initialMarkers' => $initialMarkers]);
    }
}
