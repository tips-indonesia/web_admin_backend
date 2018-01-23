
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
        ShipmentStatus::create(['step'=>1, 'description' => 'Menunggu pengambilan barang oleh Petugas TIPS.']);
        ShipmentStatus::create(['step'=>2, 'description' => 'Barang telah diterima oleh Petugas TIPS.']);
        ShipmentStatus::create(['step'=>0, 'description' => 'Barang dikirm ke Processing center.', 'is_hidden' => true]);
        ShipmentStatus::create(['step'=>0, 'description' => 'Barang diterima Processing center.', 'is_hidden' => true]);
        ShipmentStatus::create(['step'=>0, 'description' => 'Barang sudah dipacking.', 'is_hidden' => true]);
        ShipmentStatus::create(['step'=>0, 'description' => 'Barang dikirim ke konter.', 'is_hidden' => true]);
        ShipmentStatus::create(['step'=>3, 'description' => 'Menunggu diambil TIPSter.']);
        ShipmentStatus::create(['step'=>4, 'description' => 'Barang diambil TIPSter.']);
        ShipmentStatus::create(['step'=>5, 'description' => 'Barang masuk bagasi pesawat.']);
        ShipmentStatus::create(['step'=>6, 'description' => 'Barang telah tiba di konter TIPS.']);
        ShipmentStatus::create(['step'=>0, 'description' => 'Barang dikirim ke Processing center.', 'is_hidden' => true]);
        ShipmentStatus::create(['step'=>0, 'description' => 'Barang diterima Processing.', 'is_hidden' => true]);
        ShipmentStatus::create(['step'=>0, 'description' => 'Barang siap diantar.', 'is_hidden' => true]);
        ShipmentStatus::create(['step'=>7, 'description' => 'Barang dalam proses pengantaran.']);
        ShipmentStatus::create(['step'=>8, 'description' => 'Barang diterima oleh penerima.']);
    }
}
