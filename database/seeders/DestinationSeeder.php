<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('destinations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Destination::factory()
            ->count(500)
            ->create();
    }
}
