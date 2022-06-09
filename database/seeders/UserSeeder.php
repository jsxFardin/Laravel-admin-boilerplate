<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        

        $data = [
            [
                'name'      => 'Admin',
                'email'     => 'admin@test.com',
                'password'  => Hash::make('12345678'),
            ],
            [
                'name'      => 'Coordinator',
                'email'     => 'coordinator@test.com',
                'password'  => Hash::make('12345678'),
            ]
        ];

        DB::table('users')->insert($data);

        $this->command->info('Users has been created!');
    }
}
