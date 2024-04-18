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

    public function addCustomer(Request $request)
    {
        $validatedData = $request->validate([
            'klantnaam' => 'required|string|max:255',
            'email' => 'required|email|unique:klanten,email',
        ]);

        $customer = new Klant();
        $customer->fill($validatedData);
        $customer->save();

        return Redirect::route('customerlist')->with('success', 'Customer added successfully.');
    }

    public function editCustomerShow($id) {
        $customer = Klant::find($id);
        return view('administration.editcustomer', ['customer' => $customer]);
    }

    public function editCustomer(Request $request) {
        $validatedData = $request->validate([
            'original_id' => 'required',
            'klantnaam' => 'required',
            'email' => 'required|email'
        ]);

        $user = Klant::find($validatedData['original_id']);
        $user->fill($validatedData);
        $user->save();

        return Redirect::route('customerlist')->with('success', 'Customer edited successfully.');
    }


    public function customerlist(Request $request){
        $post = $request->all();

        // Start a query
        $query = Klant::query();

        // If an ID is provided, filter by ID
        if (!empty($post['id'])) {
            $query->where('id', 'like', '%' . $post['id'] . '%');
        }

        // If a name is provided, filter by name
        if (!empty($post['name'])) {
            $query->where('klantnaam', 'like', '%' . $post['name'] . '%');
        }

        // If an email is provided, filter by email
        if (!empty($post['email'])) {
            $query->where('email', 'like', '%' . $post['email'] . '%');
        }

        // Get the result
        $customers = $query->get();
        return view('administration.customerlist', ['customers' => $customers]);
    }

    public function deleteCustomer(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
        ]);

        $customer = Klant::find($validatedData['id']);
        $customer->delete();

        return Redirect::route('customerlist')->with('success', 'Customer deleted successfully.');
    }
}
