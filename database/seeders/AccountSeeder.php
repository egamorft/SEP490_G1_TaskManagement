<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class AccountSeeder extends Seeder
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
            $fullname = $faker->name;
            $avatar = Str::substr($fullname, 0, 1) . '.jpg';

            Account::create([
                'username' => $faker->userName,
                'fullname' => $fullname,
                'email' => $faker->email,
                'password' => bcrypt('password'), // Set a default password or use Faker to generate one
                'address' => $faker->address,
                'avatar' => $avatar,
                'token' => $faker->uuid,
                'is_admin' => $faker->boolean,
                'deleted_at' => null,
            ]);
        }
    }
}
