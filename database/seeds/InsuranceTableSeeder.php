<?php

use Illuminate\Database\Seeder;
use App\Insurance;
class InsuranceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Insurance::create(['default_insurance' => 0,
        	'additional_insurance' => 0
    	]);
    }
}
