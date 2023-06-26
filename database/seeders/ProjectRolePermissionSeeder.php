<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Project;
use App\Models\ProjectRolePermission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = Project::all();
        $permissions = Permission::all();
        $roles = Role::all();

        foreach ($projects as $project) {
            $randomRoles = $roles->random(3);
            foreach ($randomRoles as $role) {
                $randomPermissions = $permissions->random(3);
                foreach ($randomPermissions as $permission) {
                    ProjectRolePermission::create([
                        'project_id' => $project->id,
                        'role_id' => $role->id,
                        'permission_id' => $permission->id,
                    ]);
                }
            }
        }
    }
}
