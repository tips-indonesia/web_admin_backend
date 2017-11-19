<?php

use Illuminate\Database\Seeder;
use App\DeliveryStatus;

class DeliveryStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DeliveryStatus::create(['step'=>1, 'description' => 'Menunggu Barang Hantaran.']);
        DeliveryStatus::create(['step'=>2, 'description' => 'Barang hantaran tersedia. Konfirmasi ketersediaan mengantar.']);
        DeliveryStatus::create(['step'=>3, 'description' => 'Ambil paket hantaran.']);
        DeliveryStatus::create(['step'=>4, 'description' => 'Cek in/Drop bagasi & foto tag.']);
        DeliveryStatus::create(['step'=>5, 'description' => 'Serahkan tag bagasi.']);
        DeliveryStatus::create(['step'=>6, 'description' => 'Tag telah diterima dan bagasi sedang diverifikasi.']);
        DeliveryStatus::create(['step'=>7, 'description' => 'Bagasi Anda telah diverifikasi. Selesai.']);
    }
}
