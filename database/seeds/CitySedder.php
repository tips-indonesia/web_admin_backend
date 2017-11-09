<?php

use Illuminate\Database\Seeder;

class CitySedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('city_lists')->insert([
            'name' => 'Jakarta',
        ]);

        DB::table('city_lists')->insert([
            'name' => 'Bandung',
        ]);

        DB::table('city_lists')->insert([
            'name' => 'Surabaya',
        ]);

        DB::table('city_lists')->insert([
            'name' => 'Medan',
        ]);
    }
}
