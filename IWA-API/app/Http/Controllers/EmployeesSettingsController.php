<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeesSettingsController extends Controller
{
    public function show()
    {
        $navbar = 'layouts.admin_navbar';
        return view('admin.employees-settings', ['navbar' => $navbar]);
    }
}
