<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            // FOR Super ADMIN ROLE
            [
                'role_id' => 1,
                'user_id' => 1,
            ],
            // FOR ADMIN ROLE
            [
                'role_id' => 2,
                'user_id' => 2,
            ],
            // FOR COORDINATOR ROLE
            [
                'role_id' => 3,
                'user_id' => 3,
            ],
            [
                'role_id' => 3,
                'user_id' => 4,
            ],
            // FOR MANAGER ROLE
            [
                'role_id' => 4,
                'user_id' => 5,
            ],
            [
                'role_id' => 4,
                'user_id' => 6,
            ],
            [
                'role_id' => 4,
                'user_id' => 7,
            ],
        ];

        DB::table('role_user')->insert($data);

        $this->command->info('Role user has been created!');
    }
}
