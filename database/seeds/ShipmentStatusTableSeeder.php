
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
        ShipmentStatus::create(['step'=>1, 'description' => 'manifest']);
    }
}
