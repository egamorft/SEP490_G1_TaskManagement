<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

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
        $name = $faker->word;
        $slug = Str::slug($name, '-');

        for ($i = 0; $i < 5; $i++) {
            $project = Project::create([
                'name' => $name,
                'project_status' => $faker->randomElement([-1, 0, 1]),
                'slug' => $slug,
                'start_date' => $faker->date(),
                'end_date' => $faker->date(),
                'description' => $faker->paragraph,
                'created_at' => $faker->date(),
                'deleted_at' => $faker->randomElement([$faker->date(), null]),
            ]);
        }
    }
}
