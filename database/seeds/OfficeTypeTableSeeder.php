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
        OfficeType::create(['name' => 'Head Office']);
        OfficeType::create(['name' => 'Pick Up Drop Point']);
        OfficeType::create(['name' => 'Drop Point']);
        OfficeType::create(['name' => 'Airport Counter']);
        OfficeType::create(['name' => 'Processing Center']);
    }
}
