<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Account;
use App\Models\Task;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
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
                Comment::create([
                    'task_id' => $faker->randomElement($tasks),
                    'content' => $faker->sentence,
                    'created_by' => $faker->randomElement($accounts)
                ]);
            }
        }
    }
}
