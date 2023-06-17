<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
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
            $avatar = Str::substr($fullname, 0, 1) . '.png';

            $account = Account::create([
                'fullname' => $fullname,
                'email' => $faker->email,
                'password' => Hash::make('password'), // Set a default password or use Faker to generate one
                'address' => $faker->address,
                'avatar' => $avatar,
                'token' => null,
                'is_admin' => $faker->boolean,
                'status' => $faker->boolean,
                'deleted_at' => null,
            ]);
            
            // Assign random roles to the account
            $roles = Role::inRandomOrder()->limit(2)->get();
            $account->roles()->sync($roles->pluck('id'));
        }
    }
}
