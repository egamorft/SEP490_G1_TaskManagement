<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            $project = Project::create([
                'name' => $faker->word,
                'project_type' => $faker->randomElement(['Type A', 'Type B', 'Type C']),
                'project_status' => $faker->randomElement([-1, 0 , 1]),
                'start_date' => $faker->date(),
                'end_date' => $faker->date(),
                'description' => $faker->paragraph,
                'created_at' => $faker->date(),
                'deleted_at' => null,
            ]);

            // Assign random accounts to the project
            $accounts = Account::inRandomOrder()->limit(3)->get();
            $project->accounts()->sync($accounts->pluck('id'));
        }
    }
}
