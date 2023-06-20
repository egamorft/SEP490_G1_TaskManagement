<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        // Get the currently authenticated user
        $user = auth()->user();

        if ($user && $user->hasAnyPermission($permissions)) {
            return $next($request);
        }

        // Redirect or return a forbidden response
        return redirect()->route('dashboard')->with('error', 'Insufficient permissions.');
    }
}
