<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Roles;

class CreateUserController extends Controller
{
    public function show(): View
    {   
        $roles = Roles::getRoles();
        return view('create_user', ['roles' => $roles]);
    }
}
