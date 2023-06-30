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

        $subTasks = SubTask::pluck('id')->toArray();
        $accounts = Account::pluck('id')->toArray();

        foreach ($subTasks as $subTask) {
            for ($i = 0; $i < 5; $i++) {
                Comment::create([
                    'sub_task_id' => $faker->randomElement($subTasks),
                    'content' => $faker->sentence,
                    'visible' => $faker->boolean,
                    'created_by' => $faker->randomElement($accounts),
                    'updated_at' => $faker->randomElement([$faker->date(), null]),
                ]);
            }
        }
    }
}
