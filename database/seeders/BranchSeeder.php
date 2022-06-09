<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('branches')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'name' => 'Dhaka north'
            ],
            [
                'name' => 'Dhaka south'
            ],
            [
                'name' => 'Chattogram'
            ],
            [
                'name' => 'Gazipur'
            ],
            [
                'name' => 'Comilla'
            ],
            [
                'name' => 'Rajshahi'
            ],
            [
                'name' => 'Barishal'
            ],
        ];

        DB::table('branches')->insert($data);
        $this->command->info('Designation has been created!');
    }
}
