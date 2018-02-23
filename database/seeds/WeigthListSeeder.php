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
        for($i = 1 ; $i <= 20 ; $i++) {

            if($i == 15 || $i == 20) {
                DB::table('weight_lists')->insert([
                    'weight_kg' => $i,
                ]);
            } else {
                DB::table('weight_lists')->insert([
                    'weight_kg' => $i,
                    'for_delivery' => false
                ]);
            }
        }
    }
}
