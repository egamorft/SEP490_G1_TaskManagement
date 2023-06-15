<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Social;
use Faker\Factory as Faker;

class SocialSeeder extends Seeder
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
            Social::create([
                'provider_user_id' => $faker->unique()->randomNumber(),
                'provider' => $faker->randomElement(['Facebook', 'Google']),
                'account_id' => rand(1, 5), // Assuming you have 5 accounts in total
            ]);
        }

    }
}
