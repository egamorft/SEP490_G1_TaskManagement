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

        $accounts = Account::all();

        foreach ($accounts as $account) {
            for ($i = 0; $i < 5; $i++) {
                Report::create([
                    'created_by' => $account->id,
                    'reason' => $faker->paragraph,
                    'reported' => $account->id,
                    'image' => $faker->imageUrl(200, 200),
                    'status' => $faker->randomElement([0, 1]),
                    'response' => $faker->paragraph,
                ]);
            }
        }
    }
}
