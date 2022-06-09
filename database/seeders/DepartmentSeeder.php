<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('departments')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'name' => 'HQ'
            ],
            [
                'name' => 'Ex-HQ'
            ],
            [
                'name' => 'OS'
            ]
        ];

        DB::table('departments')->insert($data);
        
        $this->command->info('Department has been created!');
    }
}
