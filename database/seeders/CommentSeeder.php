<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\SubTask;
use App\Models\Account;
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

        $subTasks = SubTask::all();
        $accounts = Account::all();

        foreach ($subTasks as $subTask) {
            for ($i = 0; $i < 5; $i++) {
                Comment::create([
                    'sub_task_id' => $subTask->id,
                    'content' => $faker->sentence,
                    'visible' => $faker->boolean,
                    'created_by' => $accounts->random()->id,
                    'updated_at' => $faker->date(),
                ]);
            }
        }
    }
}
