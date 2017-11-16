<?php

use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('airport_lists')->insert([
            'name' => 'Husein Sastranegara International Airport',
            'initial_code' => 'BDO',
            'status' => 1,
        ]);

        DB::table('airport_lists')->insert([
            'name' => 'Blimbingsari Airport',
            'initial_code' => 'BWX',
            'status' => 1,
        ]);

        DB::table('airport_lists')->insert([
            'name' => 'Penggung Airport',
            'initial_code' => 'CBN',
            'status' => 1,
        ]);

        DB::table('airport_lists')->insert([
            'name' => 'Tunggul Wulung Airport',
            'initial_code' => 'CXP',
            'status' => 1,
        ]);

        DB::table('airport_lists')->insert([
            'name' => 'Pondok Cabe Airport',
            'initial_code' => 'PCB',
            'status' => 1,
        ]);

        DB::table('airport_lists')->insert([
            'name' => 'Halim Perdanakusuma International Airport',
            'initial_code' => 'HLP',
            'status' => 1,
        ]);

        DB::table('airport_lists')->insert([
            'name' => 'Soekarno–Hatta International Airport',
            'initial_code' => 'CGK',
            'status' => 1,
        ]);
    }
}
