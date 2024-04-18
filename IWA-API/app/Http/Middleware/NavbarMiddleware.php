<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavbarMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Check the type of the user and set the appropriate navbar
        if ($user->worker_type == 'admin') {
            view()->share('navbar', 'layouts.admin_navbar');
        } elseif ($user->worker_type == 'wetenschappelijk') {
            view()->share('navbar', 'layouts.wetenschappelijk_navbar');
        } elseif ($user->worker_type == 'administratief') {
            view()->share('navbar', 'layouts.administratief_navbar');
        } else {
            view()->share('navbar', 'layouts.navbar');
        }

        return $next($request);
    }
}
