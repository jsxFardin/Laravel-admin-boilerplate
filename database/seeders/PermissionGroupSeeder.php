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
                'name' => 'expense',
                'label' => 'Expense',
                'parent_id' => null,
                'order_no' => 2,
                'icon' => 'fas fa-money',
                'url' => 'expense',
            ],
            [
                'id' => 3,
                'name' => 'destination',
                'label' => 'Destination',
                'parent_id' => null,
                'order_no' => 3,
                'icon' => 'fas fa-map-marker',
                'url' => 'destination',
            ],
            [
                'id' => 4,
                'name' => 'settings',
                'label' => 'Settings',
                'parent_id' => null,
                'order_no' => 3,
                'icon' => 'fas fa-cogs',
                'url' => 'settings',
            ],
            [
                'id' => 5,
                'name' => 'users',
                'label' => 'Users',
                'parent_id' => 4,
                'order_no' => 1,
                'icon' => 'fas fa-users',
                'url' => 'settings/users',
            ],
            [
                'id' => 6,
                'name' => 'roles',
                'label' => 'Roles',
                'parent_id' => 4,
                'order_no' => 2,
                'icon' => 'fas fa-user-circle',
                'url' => 'settings/roles',
            ],
            [
                'id' => 7,
                'name' => 'reports',
                'label' => 'Reports',
                'parent_id' => null,
                'order_no' => 4,
                'icon' => 'fas fa-file',
                'url' => 'reports',
            ],
            [
                'id' => 8,
                'name' => 'monthly-report',
                'label' => 'Monthly Report',
                'parent_id' => 7,
                'order_no' => 1,
                'icon' => 'fas fa-teeth',
                'url' => 'reports',
            ]
        ];

        DB::table('permission_groups')->insert($data);

        $this->command->info('Permission groups has been created!');
    }
}
