<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\TaskList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TaskListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < $faker->numberBetween(3, 5); $i++) {
            TaskList::create([
                'title' => $faker->word,
                'board_id' => $faker->randomElement(Board::pluck('id')->toArray()),
                'created_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'deleted_at' => $faker->randomElement([$faker->dateTime()->format('Y-m-d H:i:s'), null]),
            ]);
        }
    }
}
