<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin account
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'admin',
            'avatar' => 'A.png',
            'token' => null,
            'is_admin' => 1,
            'status' => 1,
            'deleted_at' => null,
        ]);

        //user account
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'user',
            'avatar' => 'U.png',
            'token' => null,
            'is_admin' => 0,
            'status' => 1,
            'deleted_at' => null,
        ]);

        //supervisor account
        User::create([
            'name' => 'supervisor one',
            'email' => 'testingg@fe.edu.vn',
            'password' => Hash::make('password'),
            'address' => 'Hà Nội',
            'avatar' => 'S.png',
            'token' => null,
            'is_admin' => 0,
            'status' => 1,
            'deleted_at' => null,
        ]);

        User::create([
            'name' => 'supervisor two',
            'email' => 'testing@fe.edu.vn',
            'password' => Hash::make('password'),
            'address' => 'Hải Phòng',
            'avatar' => 'S.png',
            'token' => null,
            'is_admin' => 0,
            'status' => 1,
            'deleted_at' => null,
        ]);

        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            $name = $faker->name;
            $avatar = Str::substr($name, 0, 1) . '.png';

            User::create([
                'name' => $name,
                'email' => $faker->email,
                'password' => Hash::make('password'), // Set a default password or use Faker to generate one
                'address' => $faker->address,
                'avatar' => $avatar,
                'token' => null,
                'is_admin' => $faker->boolean,
                'status' => $faker->boolean,
                'deleted_at' => $faker->randomElement([$faker->dateTime()->format('Y-m-d H:i:s'), null]),
            ]);
        }
    }
}
