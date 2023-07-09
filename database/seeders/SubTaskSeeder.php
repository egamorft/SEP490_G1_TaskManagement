<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubTask;
use App\Models\Task;
use Faker\Factory as Faker;

class SubTaskSeeder extends Seeder
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
            $start_date = $faker->dateTimeBetween('2023-01-01', '2023-10-31')->format('Y-m-d H:i:s');
            $end_date = $faker->dateTimeBetween($start_date, $start_date.' +1 week')->format('Y-m-d H:i:s');
            SubTask::create([
                'task_id' => $faker->randomElement(Task::pluck('id')->toArray()),
                'title' => $faker->sentence,
                'assign_to' => $faker->randomElement(Account::pluck('id')->toArray()),
                'due_date' => $end_date,
                'status' => $faker->randomElement([0, 1]),
                'created_at' => $start_date,
                'deleted_at' => $faker->randomElement([$faker->dateTime()->format('Y-m-d H:i:s'), null]),
            ]);
        }
    }
}
