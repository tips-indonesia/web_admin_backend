<?php

use Illuminate\Database\Seeder;
use App\WeightList;

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
                WeightList::create([
                    'weight_kg' => $i,
                ])
            } else {
                WeightList::create([
                    'weight_kg' => $i,
                    'for_delivery' => false,
                ])
            }
        }
    }
}
