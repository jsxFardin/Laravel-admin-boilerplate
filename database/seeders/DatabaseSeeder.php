<?php

namespace Database\Seeders;

use App\Models\ExpenseType;
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

        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            PermissionGroupSeeder::class,
            PermissionSeeder::class,
            PermissionRoleSeeder::class,
            RoleUserSeeder::class,
            LocationSeeder::class,
            ExpenseTypeSeeder::class,
            DepartmentSeeder::class,
        ]);
    }
}
