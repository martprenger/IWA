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
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users,email',
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
        #TODO: does not work perfectly
        $validatedData = $request->validate([
            'original_id' => 'required',
            'id' => 'required',
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

    public function employeesSettingShow()
    {
        //get list of employees
        $employees = User::all();

        return view('admin.employees', ['employees' => $employees]);
    }

    //login employees
    public function loginShow(): View
    {
        return view('authentication.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('id', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
        }
        return redirect("login")->withSuccess('Login details are not valid');
    }


}
