<?php

namespace App\Http\Controllers;

use App\Models\AddUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AddEmployeesController extends Controller
{
    public function show()
    {
        $navbar = 'layouts.admin_navbar';
        return view('admin.addEmployee', ['navbar' => $navbar]);
    }


    public function addemployee(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = new AddUser();
        $user->fill($validatedData);
        $user->save();

        #TODO: make notification work and make redirect better
        return Redirect::route('admin')->with('success', 'Employee added successfully.');
    }
}
