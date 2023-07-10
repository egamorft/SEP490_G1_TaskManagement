<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create 3 base role for systems
        Role::create([
            'name' => 'pm',
        ]);
        Role::create([
            'name' => 'supervisor',
        ]);
        Role::create([
            'name' => 'member',
        ]);
    }
}
