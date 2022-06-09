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
            // FOR EXPENSE
            [
                'name'  => 'expense-menu',
                'label' => 'Expense',
                'permission_group_id' => 2
            ],
            [
                'name'  => 'list-expense',
                'label' => 'List Expense',
                'permission_group_id' => 2
            ],
            [
                'name'  => 'create-expense',
                'label' => 'Create Expense',
                'permission_group_id' => 2
            ],
            [
                'name'  => 'show-expense',
                'label' => 'Show Expense',
                'permission_group_id' => 2
            ],
            [
                'name'  => 'edit-expense',
                'label' => 'Edit Expense',
                'permission_group_id' => 2
            ],
            [
                'name'  => 'delete-expense',
                'label' => 'Delete Expense',
                'permission_group_id' => 2
            ],
            [
                'name'  => 'print-expense',
                'label' => 'Print Expense',
                'permission_group_id' => 2
            ],
            [
                'name'  => 'download-expense',
                'label' => 'Download Expense',
                'permission_group_id' => 2
            ],
            [
                'name'  => 'approve-list-expense',
                'label' => 'Approve List Expense',
                'permission_group_id' => 2
            ],
            [
                'name'  => 'approve-expense',
                'label' => 'Approve Expense',
                'permission_group_id' => 2
            ],

            // FOR DESTINATION
            [
                'name'  => 'list-destination',
                'label' => 'List Destination',
                'permission_group_id' => 3
            ],
            [
                'name'  => 'create-destination',
                'label' => 'Create Destination',
                'permission_group_id' => 3
            ],
            [
                'name'  => 'show-destination',
                'label' => 'Show Destination',
                'permission_group_id' => 3
            ],
            [
                'name'  => 'edit-destination',
                'label' => 'Edit Destination',
                'permission_group_id' => 3
            ],
            [
                'name'  => 'delete-destination',
                'label' => 'Delete Destination',
                'permission_group_id' => 3
            ],
            // FOR SETTINGS 
            [
                'name'  => 'settings-menu',
                'label' => 'Show Settings',
                'permission_group_id' => 4
            ],
            // FOR USER
            [
                'name'  => 'list-user',
                'label' => 'List User',
                'permission_group_id' => 5
            ],
            [
                'name'  => 'create-user',
                'label' => 'Create User',
                'permission_group_id' => 5
            ],
            [
                'name'  => 'show-user',
                'label' => 'Show User',
                'permission_group_id' => 5
            ],
            [
                'name'  => 'edit-user',
                'label' => 'Edit User',
                'permission_group_id' => 5
            ],
            [
                'name'  => 'delete-user',
                'label' => 'Delete User',
                'permission_group_id' => 5
            ],
            // FOR ROLE
            [
                'name'  => 'list-role',
                'label' => 'List Role',
                'permission_group_id' => 6
            ],
            [
                'name'  => 'create-role',
                'label' => 'Create Role',
                'permission_group_id' => 6
            ],
            [
                'name'  => 'show-role',
                'label' => 'Show Role',
                'permission_group_id' => 6
            ],
            [
                'name'  => 'edit-role',
                'label' => 'Edit Role',
                'permission_group_id' => 6
            ],
            [
                'name'  => 'delete-role',
                'label' => 'Delete Role',
                'permission_group_id' => 6
            ],
            // FOR REPORTS
            [
                'name'  => 'reports-menu',
                'label' => 'Show Reports',
                'permission_group_id' => 7
            ],
            [
                'name'  => 'show-monthly-report',
                'label' => 'Show Monthly Report',
                'permission_group_id' => 8
            ],

        ];

        DB::table('permissions')->insert($data);

        $this->command->info('Permissions has been created!');
    }
}
