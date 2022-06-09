<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permission_groups')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'id' => 1,
                'name' => 'dashboard',
                'label' => 'Dashboard',
                'parent_id' => null,
                'order_no' => 1,
                'icon' => 'fas fa-dashboard',
                'url' => 'dashboard',
            ],
            [
                'id' => 2,
                'name' => 'settings',
                'label' => 'Settings',
                'parent_id' => null,
                'order_no' => 2,
                'icon' => 'fas fa-cogs',
                'url' => 'settings',
            ],
            [
                'id' => 3,
                'name' => 'users',
                'label' => 'Users',
                'parent_id' => 2,
                'order_no' => 1,
                'icon' => 'fas fa-users',
                'url' => 'settings/users',
            ],
            [
                'id' => 4,
                'name' => 'roles',
                'label' => 'Roles',
                'parent_id' => 2,
                'order_no' => 2,
                'icon' => 'fas fa-user-circle',
                'url' => 'settings/roles',
            ],
        ];

        DB::table('permission_groups')->insert($data);

        $this->command->info('Permission groups has been created!');
    }
}
