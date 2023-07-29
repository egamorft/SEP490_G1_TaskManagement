<?php

namespace Database\Seeders;

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
            $start_date = $faker->dateTimeBetween('2023-01-01', '2023-10-31')->format('Y-m-d H:i:s');
            $end_date = $faker->dateTimeBetween($start_date, $start_date.' +2 months')->format('Y-m-d H:i:s');
            Project::create([
                'name' => $name,
                'project_status' => $faker->randomElement([-1, 0, 1]),
                'slug' => $slug . $i,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'description' => $faker->randomElement([$faker->paragraph, null]),
                'token' => $faker->uuid(),
                'created_at' => $start_date,
                'deleted_at' => $faker->randomElement([$faker->dateTime()->format('Y-m-d H:i:s'), null]),
            ]);
        }
    }
}
