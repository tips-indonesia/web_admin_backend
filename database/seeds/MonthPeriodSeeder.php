<?php

use Illuminate\Database\Seeder;

class MonthPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('month_period')->insert([
            'nama' => 'January'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'February'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'March'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'April'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'May'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'June'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'July'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'August'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'September'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'October'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'November'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'December'
        ]);
    }
}
