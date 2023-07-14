<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Project settings permissions
        Permission::create([
            'name' => 'Change project information',
            'slug' => 'change-project-information',
        ]);
        
        Permission::create([
            'name' => 'Set Up Project Privilege',
            'slug' => 'set-up-project-privilege',
        ]);
        
        Permission::create([
            'name' => 'Evaluate project',
            'slug' => 'evaluate-project',
        ]);
        
        Permission::create([
            'name' => 'Control teamsize',
            'slug' => 'control-teamsize',
        ]);
        
        Permission::create([
            'name' => 'View Member List',
            'slug' => 'view-member-list',
        ]);
        //Project settings permissions
    }
}
