<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Project;
use App\Models\TaskList;
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
        // $faker = Faker::create();

        // for ($i = 0; $i < 5; $i++) {
        //     $start_date = $faker->dateTimeBetween('2023-01-01', '2023-10-31')->format('Y-m-d H:i:s');
        //     $end_date = $faker->dateTimeBetween($start_date, $start_date.' +3 weeks')->format('Y-m-d H:i:s');
        //     Task::create([
        //         'taskList_id' => $faker->randomElement(TaskList::pluck('id')->toArray()),
        //         'title' => $faker->sentence,
        //         'due_date' => $end_date,
        //         'assign_to' => $faker->name,
        //         'status' => $faker->boolean,
        //         'attachments' => $faker->imageUrl,
        //         'description' => $faker->paragraph,
        //         'created_at' => $start_date,
        //         'deleted_at' => $faker->randomElement([$faker->dateTime()->format('Y-m-d H:i:s'), null]),
        //     ]);
        // }
    }
}
