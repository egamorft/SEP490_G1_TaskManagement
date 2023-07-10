<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\Account;
use Faker\Factory as Faker;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $accounts = Account::pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            Notification::create([
                'title' => $faker->sentence,
                'object_type' => $faker->randomElement([0, 1, 2]),
                'status' => $faker->randomElement([0, 1]),
                'sender_id' => $faker->randomElement($accounts),
                'follower' => $faker->randomElement($accounts),
                'object_id' => $faker->randomNumber(),
                'description' => $faker->paragraph,
                'created_at' => $faker->dateTime(),
            ]);
        }
    }
}
