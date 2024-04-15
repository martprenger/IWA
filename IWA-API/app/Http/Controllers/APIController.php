<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function show()
    {
        $navbar = 'layouts.admin_navbar';

        //get list of employees
        $keys = User::all();

        return view('admin.employees', ['navbar' => $navbar, 'employees' => $keys]);
    }
}
