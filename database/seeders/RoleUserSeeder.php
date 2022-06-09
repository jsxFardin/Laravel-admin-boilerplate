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
            // FOR ADMIN ROLE
            [
                'role_id' => 1,
                'user_id' => 1,
            ],
            // FOR COORDINATOR ROLE
            [
                'role_id' => 2,
                'user_id' => 2,
            ],
        ];

        DB::table('role_user')->insert($data);

        $this->command->info('Role user has been created!');
    }
}
