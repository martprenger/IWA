<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class loginController extends Controller
{
    public function show(): View
    {
        return view('login');
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
