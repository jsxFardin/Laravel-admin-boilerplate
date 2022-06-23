<?php

namespace Database\Seeders;

use App\Models\User;
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
                'name'      => 'Super Admin',
                'email'     => 'superadmin@admin.com',
                'password'  => Hash::make('12345678'),
                'mobile'    => '01759552872',
            ],
            [
                'name'      => 'Emma Grate',
                'email'     => 'admin@admin.com',
                'password'  => Hash::make('12345678'),
                'mobile'    => '01759552872',
            ],
            [
                'name'      => 'Ivan Itchinos',
                'email'     => 'coordinator@test.com',
                'password'  => Hash::make('12345678'),
                'mobile'    => '01759552871',
            ],
            // FOR MANAGER ROLE
            [
                'name'      => 'Sam Smith',
                'email'     => 'samsmith@test.com',
                'password'  => Hash::make('12345678'),
                'mobile'    => '01759552870',
            ],
            [
                'name'      => 'jane doe',
                'email'     => 'janedoe@test.com',
                'password'  => Hash::make('12345678'),
                'mobile'    => '01759552869',
            ],
            // FOR EMPLOYEE ROLE
            [
                'name'      => 'kinley adams',
                'email'     => 'kinley@test.com',
                'password'  => Hash::make('12345678'),
                'mobile'    => '01759552868',
            ],
            [
                'name'      => 'Audie Yose',
                'email'     => 'Audie@test.com',
                'password'  => Hash::make('12345678'),
                'mobile'    => '01759552867',
            ],
            [
                'name'      => 'Mark Ateer',
                'email'     => 'mark@test.com',
                'password'  => Hash::make('12345678'),
                'mobile'    => '01759552866',
            ],
        ];

        DB::table('users')->insert($data);

        User::factory()
            ->count(100)
            ->create();

        $this->command->info('Users has been created!');
    }
}
