
<?php

use Illuminate\Database\Seeder;
use App\ShipmentStatus;

class ShipmentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ShipmentStatus::create(['step'=>1, 'description' => 'Manifest']);
        ShipmentStatus::create(['step'=>2, 'description' => 'Bagasi TIPS']);
        ShipmentStatus::create(['step'=>3, 'description' => 'Pending']);
        ShipmentStatus::create(['step'=>4, 'description' => 'Received']);
    }
}
