
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
        ShipmentStatus::create(['step'=>1, 'description' => 'Menunggu Petugas TIPS.']);
        ShipmentStatus::create(['step'=>2, 'description' => 'Bagasi diproses TIPS.']);
        ShipmentStatus::create(['step'=>3, 'description' => 'Menunggu diambil TIPSter.']);
        ShipmentStatus::create(['step'=>4, 'description' => 'Barang diambil TIPSter.']);
        ShipmentStatus::create(['step'=>5, 'description' => 'Barang masuk bagasi pesawat.']);
        ShipmentStatus::create(['step'=>6, 'description' => 'Sampai di konter TIPS kota tujuan.']);
        ShipmentStatus::create(['step'=>7, 'description' => 'Barang telah sampai.']);
    }
}
