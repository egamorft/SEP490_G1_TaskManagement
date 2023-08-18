<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(AccountProjectSeeder::class);
        $this->call(ProjectRolePermissionSeeder::class);
        $this->call(SocialSeeder::class);
        $this->call(BoardSeeder::class);
        $this->call(TaskListSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(CommentSeeder::class);
        // $this->call(ReportSeeder::class);
        $this->call(NotificationSeeder::class);
    }
}
