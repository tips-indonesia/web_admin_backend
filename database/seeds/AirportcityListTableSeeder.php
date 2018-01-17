<?php

use Illuminate\Database\Seeder;

class AirportcityListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('airportcity_lists')->insert([
            'name' => 'Bandung',
        ]);
        DB::table('airportcity_lists')->insert([
            'name' => 'Jakarta',
        ]);
        DB::table('airportcity_lists')->insert([
            'name' => 'Surabaya',
        ]);
        DB::table('airportcity_lists')->insert([
            'name' => 'Medan',
        ]);
    }
}
