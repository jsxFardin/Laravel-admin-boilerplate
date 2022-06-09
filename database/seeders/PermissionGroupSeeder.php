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
                'name'  => 'Location',
            ],
            [
                'id' => 2,
                'name'  => 'Expense',
            ],
            [
                'id' => 3,
                'name'  => 'User',
            ],
            [
                'id' => 4,
                'name'  => 'Destination',
            ],
            [
                'id' => 5,
                'name'  => 'Role',
            ],

        ];

        DB::table('permission_groups')->insert($data);

        $this->command->info('Permission groups has been created!');
    }
}
