<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('expense_types')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'name' => 'Transport Allowance'
            ],
            [
                'name' => 'Daily Allowance'
            ],
            [
                'name' => 'Accommodation'
            ],
            [
                'name' => 'Others'
            ]
        ];

        DB::table('expense_types')->insert($data);
        
        $this->command->info('Expense types has been created!');
    }
}
