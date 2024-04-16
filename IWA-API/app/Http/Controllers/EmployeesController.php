<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('navbar');
    }

    //add employees
    public function addEmployeeShow()
    {
        return view('admin.addEmployee');
    }


    public function addEmployee(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|email',
            'worker_type' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->fill($validatedData);
        $user->save();

        #TODO: make notification work and make redirect better
        return Redirect::route('medewerkers')->with('success', 'Employee added successfully.');
    }

    public function deleteEmployee(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
        ]);

        $user = User::find($validatedData['id']);
        $user->delete();

        return Redirect::route('medewerkers')->with('success', 'Employee deleted successfully.');
    }

    //edit employees
    public function editEmployeeShow($id)
    {
        $employee = User::find($id);
        return view('admin.editEmployee', ['employee' => $employee]);
    }

    public function editEmployee(Request $request)
    {
        $validatedData = $request->validate([
            'original_id' => 'required',
            'id' => 'required|unique:users',
            'name' => 'required',
            'worker_type' => 'required',
            'email' => 'required|email',
        ]);

        #update existing employee
        $user = User::find($validatedData['original_id']);
        $user->fill($validatedData);
        $user->save();
        return Redirect::route('medewerkers')->with('success', 'Employee edited successfully.');
    }

    public function employeesShow(Request $request)
    {
        $post = $request->all();

        // Start a query
        $query = User::query();

        // If an ID is provided, filter by ID
        if (!empty($post['id'])) {
            $query->where('id', 'like', '%' . $post['id'] . '%');
        }

        // If a name is provided, filter by name
        if (!empty($post['name'])) {
            $query->where('name', 'like', '%' . $post['name'] . '%');
        }

        // If an email is provided, filter by email
        if (!empty($post['email'])) {
            $query->where('email', 'like', '%' . $post['email'] . '%');
        }

        // If a worker type is provided, filter by worker type
        if (!empty($post['worker_type'])) {
            $query->where('worker_type', $post['worker_type']);
        }

        // Get the result
        $employees = $query->get();

        return view('admin.employees', ['employees' => $employees]);
    }
}
