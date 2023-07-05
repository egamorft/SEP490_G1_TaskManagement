<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\Account;
use Faker\Factory as Faker;

class ReportSeeder extends Seeder
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

        foreach ($accounts as $account) {
            for ($i = 0; $i < 5; $i++) {
                Report::create([
                    'created_by' => $faker->randomElement($accounts),
                    'reason' => $faker->paragraph,
                    'reported' => $faker->randomElement($accounts),
                    'image' => $faker->imageUrl(200, 200),
                    'status' => $faker->boolean,
                    'response' => $faker->paragraph,
                ]);
            }
        }
    }
}
