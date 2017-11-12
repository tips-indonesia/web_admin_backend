<?php

use Illuminate\Database\Seeder;

class WeigthListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1 ; $i < 20 ; $i++) {
            DB::table('weight_lists')->insert([
                'weight_kg' => $i,
            ]);
        }
    }
}
