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
            'nama' => 'Januari'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'Februari'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'Maret'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'April'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'Mei'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'Juni'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'Juli'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'Agustus'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'September'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'Oktober'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'November'
        ]);
        DB::table('month_period')->insert([
            'nama' => 'Desember'
        ]);
    }
}
