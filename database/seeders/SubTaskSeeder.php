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

        $tasks = Task::all();
        
        $accounts = Account::all();

        foreach ($tasks as $task) {
            for ($i = 0; $i < 5; $i++) {
                SubTask::create([
                    'name' => $faker->word,
                    'task_id' => $task->id,
                    'image' => $faker->imageUrl(200, 200),
                    'description' => $faker->paragraph,
                    'assign_to' => $accounts->random()->id,
                    'attachment' => $faker->imageUrl(200, 200),
                    'due_date' => $faker->date(),
                    'created_at' => $faker->date(),
                    'deleted_at' => null,
                ]);
            }
        }
    }
}
