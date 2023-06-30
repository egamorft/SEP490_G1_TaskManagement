<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $permissionSlug)
    {
        // Get the project slug from the request
        $projectSlug = $request->route('slug');

        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the user is assigned to the project and has the required permission
        if ($user && $user->hasPermission($permissionSlug, $projectSlug)) {
            return $next($request);
        }

        // Redirect or return an error response if the user doesn't have the required permission
        return redirect()->back()->with('error', 'You do not have permission to access this resource.');
    }
}
