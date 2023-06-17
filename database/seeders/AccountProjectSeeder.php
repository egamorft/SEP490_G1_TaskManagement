<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountProject;
use App\Models\Project;
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
        $accounts = Account::all();
        $projects = Project::all();

        foreach ($accounts as $account) {
            $randomProjects = $projects->random(2);

            foreach ($randomProjects as $project) {
                AccountProject::create([
                    'account_id' => $account->id,
                    'project_id' => $project->id,
                ]);
            }
        }
    }
}
