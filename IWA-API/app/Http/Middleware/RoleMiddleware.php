<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect('')->with('error', "You don't have access to this page.");
        }

        // Check if the user's role matches any of the specified roles
        $userRole = Auth::user()->worker_type;
        if (!in_array($userRole, $roles)) {
            return redirect('')->with('error', "You don't have access to this page.");
        }

        return $next($request);
    }
}
