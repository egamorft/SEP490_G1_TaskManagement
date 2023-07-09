<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionProjectProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('check-permission', function ($user, $permissionSlug) {

            $projectSlug = request()->route('slug');

            $project = Project::where('slug', $projectSlug)->first();

            // Retrieve the authenticated user
            // $user = Auth::user();
            $permission = Permission::where('slug', $permissionSlug)->first();

            if ($project) {
                $role_id = $user->accountProjects()->where('slug', $projectSlug)->where('status', 1)->value('role_id');

                if ($role_id) {
                    $permissions = \DB::table('project_role_permission')
                        ->where('project_id', $project->id)
                        ->where('role_id', $role_id)
                        ->pluck('permission_id')
                        ->toArray();
						// return true;
                    return in_array($permission->id, $permissions);
                }
            }

            return false;
        });
    }
}
