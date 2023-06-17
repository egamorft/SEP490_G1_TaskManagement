<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AccountRole;
use App\Models\Account;
use App\Models\Role;

class AccountRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = Account::all();
        $roles = Role::all();

        foreach ($accounts as $account) {
            $randomRoles = $roles->random(2);

            foreach ($randomRoles as $role) {
                AccountRole::create([
                    'account_id' => $account->id,
                    'role_id' => $role->id,
                ]);
            }
        }
    }
}
