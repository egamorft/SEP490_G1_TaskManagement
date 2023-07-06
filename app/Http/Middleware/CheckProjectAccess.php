<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProjectAccess
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
        $user = Auth::user();

        $slug = $request->route('slug');

        $project = Project::where('slug', $slug)->first();

        // Check if the user has access to the project
        $hasAccess = $user->accountProjectsAccess()
            ->where('project_id', $project->id)
            ->where('status', 1)
            ->exists();

        if (!$hasAccess) {
            // Redirect or return an error response if the user doesn't have the required permission
            return redirect()->back()->with('error', 'You do not have permission to access this resource.');
        }

        return $next($request);
    }
}
