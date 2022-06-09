<?php

namespace Database\Seeders;

use App\Models\EmployeeDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EmployeeDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        EmployeeDetail::query()->truncate();
        Schema::enableForeignKeyConstraints();

        EmployeeDetail::factory()
            ->count(500)
            ->create();
    }
}
