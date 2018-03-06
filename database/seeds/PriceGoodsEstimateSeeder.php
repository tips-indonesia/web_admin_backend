<?php

use Illuminate\Database\Seeder;

class PriceGoodsEstimateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('price_goods_estimates')->insert([
            'price_estimate' => '0 - 2.000.000',
            'nominal' => 2000000
        ]);

        DB::table('price_goods_estimates')->insert([
            'price_estimate' => '2.000.001 - 5.000.000',,
            'nominal' => 5000000
        ]);

        DB::table('price_goods_estimates')->insert([
            'price_estimate' => '5.000.001 - 10.000.000',,
            'nominal' => 10000000
        ]);

        DB::table('price_goods_estimates')->insert([
            'price_estimate' => '10.000.001 - 15.000.000',,
            'nominal' => 15000000
        ]);

        DB::table('price_goods_estimates')->insert([
            'price_estimate' => '15.000.001 - 20.000.000',,
            'nominal' => 20000000
        ]);

        DB::table('price_goods_estimates')->insert([
            'price_estimate' => '20.000.001 - 25.000.000',,
            'nominal' => 25000000
        ]);

        DB::table('price_goods_estimates')->insert([
            'price_estimate' => '25.000.001 - 30.000.000',,
            'nominal' => 30000000
        ]);
    }
}
