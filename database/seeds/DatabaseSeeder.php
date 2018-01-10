<?php

use Illuminate\Database\Seeder;
use App\Barang;
use App\DaftarBarangGold;
use App\DaftarBarangRegular;
use App\SlotList;
use App\Shipment;
use App\AirportList;
use App\Term;
use App\MemberList;
use App\CityList;
use App\ProvinceList;

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
        DB::table('airport_lists')->delete();
        DB::table('city_lists')->delete();
        DB::table('shipments')->delete();
        DB::table('slot_lists')->delete();

        $p1 = ProvinceList::create(array(
            'name' => 'DKI Jakarta'
        ));
        $c1 = CityList::create(array(
            'name' => 'Jakarta Utara',
            'id_province' => 1
        ));

        $c2 = CityList::create(array(
            'name' => 'Jakarta Barat',
            'id_province' => 1
        ));

        $c3 = CityList::create(array(
            'name' => 'Jakarta Selatan',
            'id_province' => 1
        ));

        $c4 = CityList::create(array(
            'name' => 'Jakarta Pusat',
            'id_province' => 1
        ));

        $a1 = AirportList::create(array(
            'name' => 'Husein Sastranegara International Airport',
            'initial_code' => 'BDO',
            'status' => 1,
            'id_city' => $c1->id
        ));

        $a2 = AirportList::create(array(
            'name' => 'Blimbingsari Airport',
            'initial_code' => 'BWX',
            'status' => 1,
            'id_city' => $c3->id
        ));

        $a3 = AirportList::create(array(
            'name' => 'Penggung Airport',
            'initial_code' => 'CBN',
            'status' => 1,
            'id_city' => $c3->id
        ));

        $a4 = AirportList::create(array(
            'name' => 'Tunggul Wulung Airport',
            'initial_code' => 'CXP',
            'status' => 1,
            'id_city' => $c3->id
        ));

        $a5 = AirportList::create(array(
            'name' => 'Pondok Cabe Airport',
            'initial_code' => 'PCB',
            'status' => 1,
            'id_city' => $c3->id
        ));

        $a6 = AirportList::create(array(
            'name' => 'Halim Perdanakusuma International Airport',
            'initial_code' => 'HLP',
            'status' => 1,
            'id_city' => $c2->id
        ));

        $a7 = AirportList::create(array(
            'name' => 'Soekarno–Hatta International Airport',
            'initial_code' => 'CGK',
            'status' => 1,
            'id_city' => $c2->id
        ));

        $c1->airports()->attach($a1->id);
        $c2->airports()->attach($a6->id);
        $c2->airports()->attach($a7->id);
        $c3->airports()->attach($a2->id);
        $c3->airports()->attach($a3->id);
        $c3->airports()->attach($a4->id);
        $c3->airports()->attach($a5->id);

//        $member1 = MemberList::create(array(
//            'name' => 'testHAha',
//            'password' => bcrypt('password'),
//            'registered_date' => \Carbon\Carbon::now(),
//            'birth_date' => '1990-01-01',
//            'address' => 'Test Address',
//            'mobile_phone_no' => '+62123456789',
//            'email' => 'test@test.com',
//            'id_city' => 1
//        ));
//
//        SlotList::create(array(
//            'slot_id' => 'AAAB',
//        	'id_member' => $member1->id,
//            'booking_code' => 'AV12453',
//            'id_airline' => 0,
//            'id_origin_airport' => $a1->id,
//            'id_destination_airport' => $a4->id,
//            'origin_city' => 'ZZZ1',
//            'destination_city' => 'UUU1',
//            'depature' => \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2017-11-7 07:00')->toDateTimeString(),
//            'arrival' => \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2017-11-7 09:00')->toDateTimeString(),
//            'flight_code' => 'AWWWW',
//        	'baggage_space' => 30,
//            'slot_price_kg' => 12542
//        ));
//
//        SlotList::create(array(
//            'slot_id' => 'AAAB',
//            'id_member' => $member1->id,
//            'booking_code' => 'AW12454',
//            'id_airline' => 0,
//            'id_origin_airport' => $a1->id,
//            'id_destination_airport' => $a6->id,
//            'origin_city' => 'ZZZ2',
//            'destination_city' => 'UUU2',
//            'depature' => \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2017-11-7 11:00')->toDateTimeString(),
//            'arrival' => \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2017-11-7 12:00')->toDateTimeString(),
//            'flight_code' => 'AWWWW',
//            'baggage_space' => 30,
//            'slot_price_kg' => 12542
//        ));
//
//        SlotList::create(array(
//            'slot_id' => 'AAAB',
//            'id_member' => $member1->id,
//            'booking_code' => 'AX12455',
//            'id_airline' => 0,
//            'id_origin_airport' => $a7->id,
//            'id_destination_airport' => $a2->id,
//            'origin_city' => 'ZZZ3',
//            'destination_city' => 'UUU3',
//            'depature' => \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2017-11-7 08:00')->toDateTimeString(),
//            'arrival' => \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2017-11-7 10:00')->toDateTimeString(),
//            'flight_code' => 'AWWWW',
//            'baggage_space' => 30,
//            'slot_price_kg' => 12542
//        ));
//
//        $temp = Shipment::create(array(
//            'shipment_id' => 'ASB999',
//            'transaction_date' => \Carbon\Carbon::createFromFormat('Y-m-d', '2017-11-7')->toDateTimeString(),
//            'id_origin_city' => $c1->id,
//            'id_destination_city' => $c2->id,
//            'is_first_class' => true,
//            'id_shipper' => 1,
//            'shipper_name' => 'DIKA',
//            'shipper_address' => 'Jalan',
//            'shipper_mobile_phone' => '112',
//            'shipper_latitude' => 12.22,
//            'shipper_longitude' => 99.11,
//            'consignee_name' => 'PAPA',
//            'consignee_address' => 'Jalan2',
//            'consignee_mobile_phone' => '911',
//            'id_payment_type' => 0,
//            'shipment_contents' => 'BUKU',
//            'estimate_goods_value' => 5000,
//            'estimate_weight' => 6,
//            'insurance_cost' => 1000,
//            'is_add_insurance' => true,
//            'add_insurance_cost' => 102,
//            'received_time' => \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2017-11-7 02:00')->toDateTimeString(),
//        ));
//        DaftarBarangGold::create(array('id_barang' => $temp->id));
//
//
//        $temp = Shipment::create(array(
//            'shipment_id' => 'ASB1000',
//            'transaction_date' => \Carbon\Carbon::createFromFormat('Y-m-d', '2017-11-7')->toDateTimeString(),
//            'id_origin_city' => $c1->id,
//            'id_destination_city' => $c2->id,
//            'is_first_class' => true,
//            'id_shipper' => 1,
//            'shipper_name' => 'DIKA',
//            'shipper_address' => 'Jalan',
//            'shipper_mobile_phone' => '112',
//            'shipper_latitude' => 12.22,
//            'shipper_longitude' => 99.11,
//            'consignee_name' => 'PAPA',
//            'consignee_address' => 'Jalan2',
//            'consignee_mobile_phone' => '911',
//            'id_payment_type' => 0,
//            'shipment_contents' => 'BUKU',
//            'estimate_goods_value' => 5000,
//            'estimate_weight' => 6,
//            'insurance_cost' => 1000,
//            'is_add_insurance' => true,
//            'add_insurance_cost' => 102,
//            'received_time' => \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2017-11-7 12:00')->toDateTimeString(),
//        ));
//        DaftarBarangGold::create(array('id_barang' => $temp->id));
       Term::create(array('content' => 'test content'));
//        $this->call(CitySedder::class);
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
        $this->call(DeliveryStatusTableSeeder::class);
        $this->call(AirportSeeder::class);
        $this->call(FlightBookingSeeder::class);
//        $this->call(MemberListSeeder::class);
        $this->call(TipsterMilestoneTableSeeder::class);
        $this->call(HelpTipsterSeeder::class);
        $this->call(LocationTableSeeder::class);
        $this->call(LocationTableSeeder2::class);
    }
}
