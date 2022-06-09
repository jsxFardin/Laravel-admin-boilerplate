<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('designations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'name' => 'Compnay director'
            ],
            [
                'name' => 'Compnay manager'
            ],
            [
                'name' => 'Department manager'
            ],
            [
                'name' => 'Marketing manager'
            ],
            [
                'name' => 'Sales manager'
            ],
            [
                'name' => 'Ouality manager'
            ],
            [
                'name' => 'Sales executive'
            ],
            [
                'name' => 'Pharmaceutical trainee'
            ],
        ];

        DB::table('designations')->insert($data);

        $this->command->info('Designation has been created!');
    }
}
