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
            'price_estimate' => 250000,
        ]);

        DB::table('price_goods_estimates')->insert([
            'price_estimate' => 500000,
        ]);

        DB::table('price_goods_estimates')->insert([
            'price_estimate' => 1000000,
        ]);

        DB::table('price_goods_estimates')->insert([
            'price_estimate' => 2000000,
        ]);

        DB::table('price_goods_estimates')->insert([
            'price_estimate' => 5000000,
        ]);

        DB::table('price_goods_estimates')->insert([
            'price_estimate' => 10000000,
        ]);

        DB::table('price_goods_estimates')->insert([
            'price_estimate' => 20000000,
        ]);

        DB::table('price_goods_estimates')->insert([
            'price_estimate' => 300000000,
        ]);

        DB::table('price_goods_estimates')->insert([
            'price_estimate' => 500000000,
        ]);
    }
}
