<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::pluck('id')->toArray();
        $roles = Role::pluck('id')->toArray();

        foreach ($permissions as $permission) {
            foreach ($roles as $role) {
                PermissionRole::create([
                    'role_id' => $role,
                    'permission_id' => $permission,
                ]);
            }
        }
    }
}
