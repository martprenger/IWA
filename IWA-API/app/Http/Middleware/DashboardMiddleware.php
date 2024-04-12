<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Check the type of the user and set the appropriate dashboard
        if ($user->worker_type == 'admin') {
            view()->share('dashboard', 'dashboard.admin_dashboard');
        } elseif ($user->worker_type == 'wetenschappelijk') {
            view()->share('dashboard', 'dashboard.wetenschappelijk_dashboard');
        } elseif ($user->worker_type == 'administratief') {
            view()->share('dashboard', 'dashboard.administratief_dashboard');
        } else {
            view()->share('dashboard', 'dashboard.dashboard');
        }

        return $next($request);
    }
}
