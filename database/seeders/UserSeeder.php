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
                'name'      => 'Emma Grate',
                'email'     => 'admin@test.com',
                'password'  => Hash::make('12345678'),
            ],
            [
                'name'      => 'Ivan Itchinos',
                'email'     => 'coordinator@test.com',
                'password'  => Hash::make('12345678'),
            ],
            // FOR MANAGER ROLE
            [
                'name'      => 'Sam Smith',
                'email'     => 'samsmith@test.com',
                'password'  => Hash::make('12345678'),
            ],
            [
                'name'      => 'jane doe',
                'email'     => 'janedoe@test.com',
                'password'  => Hash::make('12345678'),
            ],
            // FOR EMPLOYEE ROLE
            [
                'name'      => 'kinley adams',
                'email'     => 'kinley@test.com',
                'password'  => Hash::make('12345678'),
            ],
            [
                'name'      => 'Audie Yose',
                'email'     => 'Audie@test.com',
                'password'  => Hash::make('12345678'),
            ],
            [
                'name'      => 'Mark Ateer',
                'email'     => 'mark@test.com',
                'password'  => Hash::make('12345678'),
            ],
        ];

        DB::table('users')->insert($data);

        User::factory()
            ->count(500)
            ->create();

        $this->command->info('Users has been created!');
    }
}
