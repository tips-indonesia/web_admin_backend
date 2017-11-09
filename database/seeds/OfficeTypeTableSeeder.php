<?php

use Illuminate\Database\Seeder;
use App\OfficeType;

class OfficeTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        OfficeType::create(['name' => 'Counter']);
        OfficeType::create(['name' => 'Processing Center']);
    }
}
