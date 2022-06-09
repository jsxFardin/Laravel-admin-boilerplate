<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $data = [
            // FOR DASHBOARD
            [
                'name'  => 'dashboard-menu',
                'label' => 'Dashboard',
                'permission_group_id' => 1
            ],
            // FOR SETTINGS 
            [
                'name'  => 'settings-menu',
                'label' => 'Show Settings',
                'permission_group_id' => 2
            ],
            // FOR USER
            [
                'name'  => 'list-user',
                'label' => 'List User',
                'permission_group_id' => 3
            ],
            [
                'name'  => 'create-user',
                'label' => 'Create User',
                'permission_group_id' => 3
            ],
            [
                'name'  => 'show-user',
                'label' => 'Show User',
                'permission_group_id' => 3
            ],
            [
                'name'  => 'edit-user',
                'label' => 'Edit User',
                'permission_group_id' => 3
            ],
            [
                'name'  => 'delete-user',
                'label' => 'Delete User',
                'permission_group_id' => 3
            ],
            // FOR ROLE
            [
                'name'  => 'list-role',
                'label' => 'List Role',
                'permission_group_id' => 4
            ],
            [
                'name'  => 'create-role',
                'label' => 'Create Role',
                'permission_group_id' => 4
            ],
            [
                'name'  => 'show-role',
                'label' => 'Show Role',
                'permission_group_id' => 4
            ],
            [
                'name'  => 'edit-role',
                'label' => 'Edit Role',
                'permission_group_id' => 4
            ],
            [
                'name'  => 'delete-role',
                'label' => 'Delete Role',
                'permission_group_id' => 4
            ]
        ];

        DB::table('permissions')->insert($data);

        $this->command->info('Permissions has been created!');
    }
}
