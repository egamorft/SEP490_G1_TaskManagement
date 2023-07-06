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

        $tasks = Task::pluck('id')->toArray();

        $accounts = Account::pluck('id')->toArray();

        foreach ($tasks as $task) {
            for ($i = 0; $i < 5; $i++) {
                SubTask::create([
                    'name' => $faker->word,
                    'task_id' => $faker->randomElement($tasks),
                    'image' => $faker->imageUrl(200, 200),
                    'description' => $faker->paragraph,
                    'assign_to' => $faker->randomElement($accounts),
                    'review_by' => $faker->randomElement($accounts),
                    'created_by' => $faker->randomElement($accounts),
                    'attachment' => $faker->imageUrl(200, 200),
                    'start_date' => $faker->date(),
                    'due_date' => $faker->date(),
                    'created_at' => $faker->date(),
                    'deleted_at' => $faker->randomElement([$faker->date(), null]),
                ]);
            }
        }
    }
}
