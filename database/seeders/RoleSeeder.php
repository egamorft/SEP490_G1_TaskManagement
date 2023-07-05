<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        Role::create([
            'name' => 'pm',
        ]);
        Role::create([
            'name' => 'supervisor',
        ]);
        Role::create([
            'name' => 'member',
        ]);
        for ($i = 0; $i < 2; $i++) {
            Role::create([
                'name' => $faker->word,
            ]);
        }
    }
}
