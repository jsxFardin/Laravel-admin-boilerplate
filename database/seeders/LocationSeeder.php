<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('locations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $data = [
            [
                'name'  =>  'Adabor'
            ],
            [
                'name'  =>  'Uttar Khan'
            ],
            [
                'name'  =>  'Uttara'
            ],
            [
                'name'  =>  'Kadamtali'
            ],
            [
                'name'  =>  'Kalabagan'
            ],
            [
                'name'  =>  'Kafrul'
            ],
            [
                'name'  =>  'Kamrangirchar'
            ],
            [
                'name'  =>  'Cantonment'
            ],
            [
                'name'  =>  'Kotwali'
            ],
            [
                'name'  =>  'Khilkhet'
            ],
            [
                'name'  =>  'Khilgaon'
            ],
            [
                'name'  =>  'Gulshan'
            ],
            [
                'name'  =>  'Gendaria'
            ],
            [
                'name'  =>  'Chawkbazar Model'
            ],
            [
                'name'  =>  'Demra'
            ],
            [
                'name'  =>  'Turag'
            ],
            [
                'name'  =>  'Tejgaon'
            ],

            [
                'name'  =>  'Dakshinkhan'
            ],
            [
                'name'  =>  'Darus Salam'
            ],
            [
                'name'  =>  'Dhanmondi'
            ],
            [
                'name'  =>  'New Market'
            ],
            [
                'name'  =>  'Paltan'
            ],
            [
                'name'  =>  'Pallabi'
            ],
            [
                'name'  =>  'Bangshal'
            ],
            [
                'name'  =>  'Badda'
            ],
            [
                'name'  =>  'Bimanbandar'
            ],
            [
                'name'  =>  'Motijheel'
            ],
            [
                'name'  =>  'Mirpur Model'
            ],
            [
                'name'  =>  'Mirpur 1'
            ],
            [
                'name'  =>  'Mirpur 2'
            ],
            [
                'name'  =>  'Mirpur 6'
            ],
            [
                'name'  =>  'Mirpur 7'
            ],
            [
                'name'  =>  'Mirpur 10'
            ],
            [
                'name'  =>  'Mirpur 11'
            ],
            [
                'name'  =>  'Mirpur 12'
            ],
            [
                'name'  =>  'Mirpur 13'
            ],
            [
                'name'  =>  'Mirpur 14'
            ],
            [
                'name'  =>  'Mohammadpur'
            ],
            [
                'name'  =>  'Jatrabari'
            ],
            [
                'name'  =>  'Ramna'
            ],
            [
                'name'  =>  'Rampura'
            ],
            [
                'name'  =>  'Lalbagh'
            ],
            [
                'name'  =>  'Shah Ali'
            ],
            [
                'name'  =>  'Shahbagh'
            ],
            [
                'name'  =>  'Sher-e-Bangla Nagar'
            ],
            [
                'name'  =>  'Shyampur'
            ],
            [
                'name'  =>  'Sabujbagh'
            ],
            [
                'name'  =>  'Sutrapur'
            ],
            [
                'name'  =>  'Hazaribagh'
            ]
        ];

        DB::table('locations')->insert($data);
        $this->command->info('Locations has been created!');
    }
}
