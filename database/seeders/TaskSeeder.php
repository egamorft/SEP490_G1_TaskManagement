<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Project;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $projects = Project::all();

        foreach ($projects as $project) {
            for ($i = 0; $i < 5; $i++) {
                Task::create([
                    'name' => $faker->word,
                    'project_id' => $project->id,
                    'limitation' => $faker->randomNumber(),
                    'description' => $faker->paragraph,
                ]);
            }
        }
    }
}
