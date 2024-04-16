<?php

namespace App\Http\Controllers;

use App\Models\Contracten;
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
            'klantenID' => 'required',
            'actief' => 'required|boolean',
        ]);

        $contract = new Contracten();
        $contract->fill($validatedData);
        $contract->save();

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
}
