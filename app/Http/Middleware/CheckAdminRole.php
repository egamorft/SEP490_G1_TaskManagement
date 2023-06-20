<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // Get the currently authenticated user
        $user = auth()->user();

        // Check if the user is logged in and the 'is_admin' value is 1
        if ($user && $user->is_admin == 1) {
            // User is an admin, allow access
            return $next($request);
        }

        // User is not an admin, redirect or show an error page
        return redirect()->route('dashboard')->with('error', 'Insufficient admin permissions.');
    }
}
