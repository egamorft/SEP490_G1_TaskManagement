<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountProject;
use App\Models\Project;
use App\Models\Role;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $accounts = Account::pluck('id')->toArray();
        $projects = Project::pluck('id')->toArray();
        $roles = Role::pluck('id')->toArray();
        foreach ($accounts as $account) {
            foreach ($projects as $project) {
                $role = $faker->randomElement($roles);

                AccountProject::create([
                    'project_id' => $project,
                    'account_id' => $account,
                    'role_id' => $role,
                ]);
            }
        }
    }
}
