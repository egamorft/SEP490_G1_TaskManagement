<?php

namespace App\Http\Middleware;

use App\Models\Project;
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

        $project = Project::where('slug', $projectSlug)->first();

        // Retrieve the authenticated user
        $user = Auth::user();

        // Retrieve the role of the user in the current project
        $role_id = $user->accountProjects()->where('slug', $projectSlug)->where('status', 1)->value('role_id');
        if ($role_id) {
            // Fetch the permissions for the user's role in the current project
            $permissions = \DB::table('project_role_permission')
                ->where('project_id', $project->id)
                ->where('role_id', $role_id)
                ->pluck('permission_id')
                ->toArray();

            // Check if the user has the required permission
            if (in_array($permissionSlug, $permissions)) {
                return $next($request);
            }
            // Redirect or return an error response if the user doesn't have the required permission
            return redirect()->back()->with('error', 'You do not have permission to access this resource.');
        }
        // Redirect or return an error response if the user doesn't have the required permission
        return redirect()->back()->with('error', 'Something wrong with your role here');

    }
}
