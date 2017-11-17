<?php

use Illuminate\Database\Seeder;
use App\Keberangkatan;
use App\Barang;
use App\DaftarBarangGold;
use App\DaftarBarangRegular;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('daftar_barang_regulars')->delete();
        DB::table('daftar_barang_golds')->delete();
        DB::table('keberangkatans')->delete();
        DB::table('barangs')->delete();

        Keberangkatan::create(array(
        	'id_tipster' => 0,
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'dt_berangkat' => \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2017-11-7 07:00')->toDateTimeString(),
        	'berat_tersedia' => 30
        ));

        Keberangkatan::create(array(
        	'id_tipster' => 1,
        	'asal' => 'BDO',
        	'tujuan' => 'SBY',
        	'dt_berangkat' => \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2017-11-7 08:00')->toDateTimeString(),
        	'berat_tersedia' => 25
        ));

        Keberangkatan::create(array(
        	'id_tipster' => 2,
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'dt_berangkat' => \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2017-11-7 08:00')->toDateTimeString(),
        	'berat_tersedia' => 28
        ));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'REGULAR',
        	'created_at' => \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2017-11-7 02:00')->toDateTimeString(),
        	'berat' => 6
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'REGULAR',
        	'berat' => 2
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'REGULAR',
        	'berat' => 13
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'REGULAR',
        	'berat' => 11
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'REGULAR',
        	'berat' => 9
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'REGULAR',
        	'berat' => 16
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'REGULAR',
        	'berat' => 5
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'REGULAR',
        	'berat' => 6
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'GOLD',
        	'berat' => 4
        ));
        DaftarBarangGold::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'REGULAR',
        	'berat' => 7
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'GOLD',
        	'berat' => 6
        ));
        DaftarBarangGold::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'GOLD',
        	'berat' => 8
        ));
        DaftarBarangGold::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'REGULAR',
        	'berat' => 11
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'REGULAR',
        	'berat' => 17
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'SBY',
        	'jenis' => 'REGULAR',
        	'berat' => 13
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'REGULAR',
        	'berat' => 4
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'REGULAR',
        	'berat' => 5
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $temp = Barang::create(array(
        	'asal' => 'BDO',
        	'tujuan' => 'JKT',
        	'jenis' => 'REGULAR',
        	'berat' => 1
        ));
        DaftarBarangRegular::create(array('id_barang' => $temp->id));

        $this->call(CitySedder::class);
//        $this->call(MemberListSeeder::class);
        $this->call(WeigthListSeeder::class);
        $this->call(PriceListSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(MenuTableSeeder::class);
//        $this->call(RegionListTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(OfficeTypeTableSeeder::class);
        $this->call(InsuranceTableSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(PriceGoodsEstimateSeeder::class);
        $this->call(ShipmentStatusTableSeeder::class);
        $this->call(AirportSeeder::class);
        $this->call(FlightBookingSeeder::class);
    }
}
