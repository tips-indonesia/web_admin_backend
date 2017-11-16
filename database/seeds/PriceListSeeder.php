<?php

use Illuminate\Database\Seeder;

class PriceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1 ; $i <= 4 ; $i++) {
            for($j = 1 ; $j <= 4 ; $j++) {
                if($i != $j) {
                    $random_price = rand(10, 20);
                    $add_first_class = rand(3,5);
                    DB::table('price_lists')->insert([
                        'id_origin_city' => $i,
                        'id_destination_city' => $j,
                        'tipster_price' => $random_price * 1000,
                        'freight_cost' => ($random_price+2)*1000,
                        'add_first_class' => $add_first_class*1000,
                    ]);
                }
            }
        }
    }
}
