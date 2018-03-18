<?php

use Illuminate\Database\Seeder;

class YearPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('year_period')->insert([
            'year_period' => '2018'
        ]);
        DB::table('year_period')->insert([
            'year_period' => '2019'
        ]);
        DB::table('year_period')->insert([
            'year_period' => '2020'
        ]);
    }
}
