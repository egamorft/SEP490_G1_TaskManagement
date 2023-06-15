<?php

namespace Database\Seeders;

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
        $roles = Role::pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            PermissionRole::create([
                'role_id' => $roles[array_rand($roles)],
                'permission_id' => rand(1, 5), // Assuming you have 5 permissions in total
            ]);
        }
    }
}
