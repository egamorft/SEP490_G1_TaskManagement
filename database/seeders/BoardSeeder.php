<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BoardSeeder extends Seeder
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
            Board::create([
                'title' => $faker->word,
                'project_id' => $faker->randomElement(Project::pluck('id')->toArray()),
                'limitation' => $faker->numberBetween(3, 7),
                'created_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'deleted_at' => $faker->randomElement([$faker->dateTime()->format('Y-m-d H:i:s'), null]),
            ]);
        }
    }
}
