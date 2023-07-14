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
        $projects = Project::pluck('id')->toArray();
        $roles = Role::pluck('id')->toArray();
        $permissions = Permission::pluck('id')->toArray();

        foreach ($projects as $project) {
            foreach ($roles as $role) {
                foreach ($permissions as $permission) {
                    ProjectRolePermission::create([
                        'project_id' => $project,
                        'role_id' => $role,
                        'permission_id' => $permission,
                    ]);
                }
            }
        }
    }
}
