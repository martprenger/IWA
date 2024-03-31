<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show()
    {
        $navbar = 'layouts.admin_navbar';
        return view('admin.admin', ['navbar' => $navbar]);
    }
}
