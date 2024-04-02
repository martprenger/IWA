<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogsMedewerkersController extends Controller
{
    public function show()
    {
        $navbar = 'layouts.admin_navbar';
        return view('admin.logs', ['navbar' => $navbar]);
    }
}
