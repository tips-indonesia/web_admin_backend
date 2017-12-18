<?php

use Illuminate\Database\Seeder;
use App\TipsterMilestone;

class TipsterMilestoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TipsterMilestone::create(['step'=>1, 'description' => 'Menunggu Petugas TIPS.']);
        TipsterMilestone::create(['step'=>2, 'description' => 'Bagasi diproses TIPS.']);
        TipsterMilestone::create(['step'=>3, 'description' => 'Menunggu diambil TIPSter.']);
        TipsterMilestone::create(['step'=>4, 'description' => 'Barang diambil TIPSter.']);
        TipsterMilestone::create(['step'=>5, 'description' => 'Barang masuk bagasi pesawat.']);
        TipsterMilestone::create(['step'=>6, 'description' => 'Sampai di konter TIPS kota tujuan.']);
        TipsterMilestone::create(['step'=>7, 'description' => 'Barang telah sampai.']);
    }
}
