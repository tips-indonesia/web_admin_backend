<?php

use Illuminate\Database\Seeder;
use App\Barang;
use App\DaftarBarangGold;
use App\DaftarBarangRegular;
use App\SlotList;
use App\Shipment;
use App\AirportList;
use App\AirlinesList;
use App\AirportcityList;
use App\Term;
use App\MemberList;
use App\PaymentType;
use App\CityList;
use App\PriceList;
use App\SubdistrictList;
use App\AirportcityCityPivot;
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

        AirlinesList::create([
            'name' => 'Garuda Airlines',
            'prefix_flight_code' => 'GA',
            'status' => true
        ]);

        AirlinesList::create([
            'name' => 'Citilink',
            'prefix_flight_code' => 'QZ',
            'status' => true
        ]);

        $airportcityList_Jakarta = AirportcityList::create([
            'name' => 'Jakarta'
        ]);

        $airportcityList_Bali = AirportcityList::create([
            'name' => 'Bali'
        ]);

        PriceList::create([
            'id_origin_city' => $airportcityList_Jakarta->id,
            'id_destination_city' => $airportcityList_Bali->id,
            'tipster_price' => 10000.00,
            'freight_cost' => 30000.00,
            'add_first_class' => 0.00 
        ]);

        PriceList::create([
            'id_origin_city' => $airportcityList_Bali->id,
            'id_destination_city' => $airportcityList_Jakarta->id,
            'tipster_price' => 10000.00,
            'freight_cost' => 30000.00,
            'add_first_class' => 0.00 
        ]);

        $airportList_CGK = AirportList::create(array(
            'name' => 'Soekarno–Hatta International Airport',
            'initial_code' => 'CGK',
            'status' => 1,
            'id_city' => $airportcityList_Jakarta->id
        ));

        $airportList_DPS = AirportList::create(array(
            'name' => 'Ngurah Rai International Airport',
            'initial_code' => 'DPS',
            'status' => 1,
            'id_city' => $airportcityList_Bali->id
        ));

        $province_Jakarta = ProvinceList::create(array(
            'name' => 'DKI Jakarta'
        ));

        $province_Banten = ProvinceList::create(array(
            'name' => 'Banten'
        ));

        $province_JawaBarat = ProvinceList::create(array(
            'name' => 'Jawa Barat'
        ));

        $province_Bali = ProvinceList::create(array(
            'name' => 'Bali'
        ));

        $city_jakarta_Jakut = CityList::create(array(
            'name' => 'Jakarta Utara',
            'id_province' => $province_Jakarta->id,
            'id_airportcity' => $airportcityList_Jakarta->id,
        ));

        $city_jakarta_Jakbar = CityList::create(array(
            'name' => 'Jakarta Barat',
            'id_province' => $province_Jakarta->id,
            'id_airportcity' => $airportcityList_Jakarta->id,
        ));

        $city_jakarta_Jaksel = CityList::create(array(
            'name' => 'Jakarta Selatan',
            'id_province' => $province_Jakarta->id,
            'id_airportcity' => $airportcityList_Jakarta->id,
        ));

        $city_jakarta_Jakpus = CityList::create(array(
            'name' => 'Jakarta Pusat',
            'id_province' => $province_Jakarta->id,
            'id_airportcity' => $airportcityList_Jakarta->id,
        ));

        $city_jakarta_Jaktim = CityList::create(array(
            'name' => 'Jakarta Timur',
            'id_province' => $province_Jakarta->id,
            'id_airportcity' => $airportcityList_Jakarta->id,
        ));

        $city_banten_Tangerang = CityList::create(array(
            'name' => 'Kota Tangerang',
            'id_province' => $province_Banten->id,
            'id_airportcity' => $airportcityList_Jakarta->id,
        ));

        $city_banten_Tangsel = CityList::create(array(
            'name' => 'Kota Tangerang Selatan',
            'id_province' => $province_Banten->id,
            'id_airportcity' => $airportcityList_Jakarta->id,
        ));

        $city_jabar_Depok = CityList::create(array(
            'name' => 'Kota Depok',
            'id_province' => $province_JawaBarat->id,
            'id_airportcity' => $airportcityList_Jakarta->id,
        ));

        $city_jabar_Bekasi = CityList::create(array(
            'name' => 'Kota Bekasi',
            'id_province' => $province_JawaBarat->id,
            'id_airportcity' => $airportcityList_Jakarta->id,
        ));

        $city_bali_Denpasar = CityList::create(array(
            'name' => 'Kota Denpasar',
            'id_province' => $province_Bali->id,
            'id_airportcity' => $airportcityList_Bali->id,
        ));

        $city_bali_Badung = CityList::create(array(
            'name' => 'Kabupaten Badung',
            'id_province' => $province_Bali->id,
            'id_airportcity' => $airportcityList_Bali->id,
        ));

        // Jakut
        $sub = SubdistrictList::create(array(
            'name' => 'Cilincing',
            'id_province' => $city_jakarta_Jakut->id_province,
            'id_city' => $city_jakarta_Jakut->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Koja',
            'id_province' => $city_jakarta_Jakut->id_province,
            'id_city' => $city_jakarta_Jakut->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Kelapa Gading',
            'id_province' => $city_jakarta_Jakut->id_province,
            'id_city' => $city_jakarta_Jakut->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Tanjung Priok',
            'id_province' => $city_jakarta_Jakut->id_province,
            'id_city' => $city_jakarta_Jakut->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Pademangan',
            'id_province' => $city_jakarta_Jakut->id_province,
            'id_city' => $city_jakarta_Jakut->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Penjaringan',
            'id_province' => $city_jakarta_Jakut->id_province,
            'id_city' => $city_jakarta_Jakut->id,
        ));

        // Jakabr
        $sub = SubdistrictList::create(array(
            'name' => 'Cengkareng',
            'id_province' => $city_jakarta_Jakbar->id_province,
            'id_city' => $city_jakarta_Jakbar->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Grogol Petamburan',
            'id_province' => $city_jakarta_Jakbar->id_province,
            'id_city' => $city_jakarta_Jakbar->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Kalideres',
            'id_province' => $city_jakarta_Jakbar->id_province,
            'id_city' => $city_jakarta_Jakbar->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Kebon Jeruk',
            'id_province' => $city_jakarta_Jakbar->id_province,
            'id_city' => $city_jakarta_Jakbar->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Kembangan',
            'id_province' => $city_jakarta_Jakbar->id_province,
            'id_city' => $city_jakarta_Jakbar->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Palmerah',
            'id_province' => $city_jakarta_Jakbar->id_province,
            'id_city' => $city_jakarta_Jakbar->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Taman Sari',
            'id_province' => $city_jakarta_Jakbar->id_province,
            'id_city' => $city_jakarta_Jakbar->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Tambora',
            'id_province' => $city_jakarta_Jakbar->id_province,
            'id_city' => $city_jakarta_Jakbar->id,
        ));


        // Jakpus
        $sub = SubdistrictList::create(array(
            'name' => 'Gambir',
            'id_province' => $city_jakarta_Jakpus->id_province,
            'id_city' => $city_jakarta_Jakpus->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Tanah Abang',
            'id_province' => $city_jakarta_Jakpus->id_province,
            'id_city' => $city_jakarta_Jakpus->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Menteng',
            'id_province' => $city_jakarta_Jakpus->id_province,
            'id_city' => $city_jakarta_Jakpus->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Senen',
            'id_province' => $city_jakarta_Jakpus->id_province,
            'id_city' => $city_jakarta_Jakpus->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Cempaka Putih',
            'id_province' => $city_jakarta_Jakpus->id_province,
            'id_city' => $city_jakarta_Jakpus->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Johar Baru',
            'id_province' => $city_jakarta_Jakpus->id_province,
            'id_city' => $city_jakarta_Jakpus->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Kemayoran',
            'id_province' => $city_jakarta_Jakpus->id_province,
            'id_city' => $city_jakarta_Jakpus->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Sawah Besar',
            'id_province' => $city_jakarta_Jakpus->id_province,
            'id_city' => $city_jakarta_Jakpus->id,
        ));


        // Jaksel
        $sub = SubdistrictList::create(array(
            'name' => 'Kebayoran Baru',
            'id_province' => $city_jakarta_Jaksel->id_province,
            'id_city' => $city_jakarta_Jaksel->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Kebayoran Lama',
            'id_province' => $city_jakarta_Jaksel->id_province,
            'id_city' => $city_jakarta_Jaksel->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Pesanggrahan',
            'id_province' => $city_jakarta_Jaksel->id_province,
            'id_city' => $city_jakarta_Jaksel->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Cilandak',
            'id_province' => $city_jakarta_Jaksel->id_province,
            'id_city' => $city_jakarta_Jaksel->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Pasar Minggu',
            'id_province' => $city_jakarta_Jaksel->id_province,
            'id_city' => $city_jakarta_Jaksel->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Jagakarsa',
            'id_province' => $city_jakarta_Jaksel->id_province,
            'id_city' => $city_jakarta_Jaksel->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Mampang Prapatan',
            'id_province' => $city_jakarta_Jaksel->id_province,
            'id_city' => $city_jakarta_Jaksel->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Pancoran',
            'id_province' => $city_jakarta_Jaksel->id_province,
            'id_city' => $city_jakarta_Jaksel->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Tebet',
            'id_province' => $city_jakarta_Jaksel->id_province,
            'id_city' => $city_jakarta_Jaksel->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Setiabudi',
            'id_province' => $city_jakarta_Jaksel->id_province,
            'id_city' => $city_jakarta_Jaksel->id,
        ));


        // Jaktim
        $sub = SubdistrictList::create(array(
            'name' => 'Matraman',
            'id_province' => $city_jakarta_Jaktim->id_province,
            'id_city' => $city_jakarta_Jaktim->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Pulo Gadung',
            'id_province' => $city_jakarta_Jaktim->id_province,
            'id_city' => $city_jakarta_Jaktim->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Jatinegara',
            'id_province' => $city_jakarta_Jaktim->id_province,
            'id_city' => $city_jakarta_Jaktim->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Duren Sawit',
            'id_province' => $city_jakarta_Jaktim->id_province,
            'id_city' => $city_jakarta_Jaktim->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Kramat Jati',
            'id_province' => $city_jakarta_Jaktim->id_province,
            'id_city' => $city_jakarta_Jaktim->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Makasar',
            'id_province' => $city_jakarta_Jaktim->id_province,
            'id_city' => $city_jakarta_Jaktim->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Pasar Rebo',
            'id_province' => $city_jakarta_Jaktim->id_province,
            'id_city' => $city_jakarta_Jaktim->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Ciracas',
            'id_province' => $city_jakarta_Jaktim->id_province,
            'id_city' => $city_jakarta_Jaktim->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Cipayung',
            'id_province' => $city_jakarta_Jaktim->id_province,
            'id_city' => $city_jakarta_Jaktim->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Cakung',
            'id_province' => $city_jakarta_Jaktim->id_province,
            'id_city' => $city_jakarta_Jaktim->id,
        ));

        
        // kota denpasar
        $sub = SubdistrictList::create(array(
            'name' => 'Denpasar Barat',
            'id_province' => $city_bali_Denpasar->id_province,
            'id_city' => $city_bali_Denpasar->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Denpasar Selatan',
            'id_province' => $city_bali_Denpasar->id_province,
            'id_city' => $city_bali_Denpasar->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Denpasar Timur',
            'id_province' => $city_bali_Denpasar->id_province,
            'id_city' => $city_bali_Denpasar->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Denpasar Utara',
            'id_province' => $city_bali_Denpasar->id_province,
            'id_city' => $city_bali_Denpasar->id,
        ));

        
        // kab badung
        $sub = SubdistrictList::create(array(
            'name' => 'Abiansemal',
            'id_province' => $city_bali_Badung->id_province,
            'id_city' => $city_bali_Badung->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Kuta Selatan',
            'id_province' => $city_bali_Badung->id_province,
            'id_city' => $city_bali_Badung->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Kuta Utara',
            'id_province' => $city_bali_Badung->id_province,
            'id_city' => $city_bali_Badung->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Kuta',
            'id_province' => $city_bali_Badung->id_province,
            'id_city' => $city_bali_Badung->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Mengwi',
            'id_province' => $city_bali_Badung->id_province,
            'id_city' => $city_bali_Badung->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Petang',
            'id_province' => $city_bali_Badung->id_province,
            'id_city' => $city_bali_Badung->id,
        ));


        // Kota tangerang
        $sub = SubdistrictList::create(array(
            'name' => 'Batuceper',
            'id_province' => $city_banten_Tangerang->id_province,
            'id_city' => $city_banten_Tangerang->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Benda',
            'id_province' => $city_banten_Tangerang->id_province,
            'id_city' => $city_banten_Tangerang->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Cibodas',
            'id_province' => $city_banten_Tangerang->id_province,
            'id_city' => $city_banten_Tangerang->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Ciledug',
            'id_province' => $city_banten_Tangerang->id_province,
            'id_city' => $city_banten_Tangerang->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Cipondoh',
            'id_province' => $city_banten_Tangerang->id_province,
            'id_city' => $city_banten_Tangerang->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Jatiuwung',
            'id_province' => $city_banten_Tangerang->id_province,
            'id_city' => $city_banten_Tangerang->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Karang Tengah',
            'id_province' => $city_banten_Tangerang->id_province,
            'id_city' => $city_banten_Tangerang->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Karawaci',
            'id_province' => $city_banten_Tangerang->id_province,
            'id_city' => $city_banten_Tangerang->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Larangan',
            'id_province' => $city_banten_Tangerang->id_province,
            'id_city' => $city_banten_Tangerang->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Neglasari',
            'id_province' => $city_banten_Tangerang->id_province,
            'id_city' => $city_banten_Tangerang->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Periuk',
            'id_province' => $city_banten_Tangerang->id_province,
            'id_city' => $city_banten_Tangerang->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Pinang',
            'id_province' => $city_banten_Tangerang->id_province,
            'id_city' => $city_banten_Tangerang->id,
        ));

        
        // kota tangsel
        $sub = SubdistrictList::create(array(
            'name' => 'Ciputat',
            'id_province' => $city_banten_Tangsel->id_province,
            'id_city' => $city_banten_Tangsel->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Ciputat Timur',
            'id_province' => $city_banten_Tangsel->id_province,
            'id_city' => $city_banten_Tangsel->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Pamulang',
            'id_province' => $city_banten_Tangsel->id_province,
            'id_city' => $city_banten_Tangsel->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Pondok Aren',
            'id_province' => $city_banten_Tangsel->id_province,
            'id_city' => $city_banten_Tangsel->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Serpong',
            'id_province' => $city_banten_Tangsel->id_province,
            'id_city' => $city_banten_Tangsel->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Serpong Utara',
            'id_province' => $city_banten_Tangsel->id_province,
            'id_city' => $city_banten_Tangsel->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Setu',
            'id_province' => $city_banten_Tangsel->id_province,
            'id_city' => $city_banten_Tangsel->id,
        ));


        // Kota depok
        $sub = SubdistrictList::create(array(
            'name' => 'Beji',
            'id_province' => $city_jabar_Depok->id_province,
            'id_city' => $city_jabar_Depok->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Bojongsari',
            'id_province' => $city_jabar_Depok->id_province,
            'id_city' => $city_jabar_Depok->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Cilodong',
            'id_province' => $city_jabar_Depok->id_province,
            'id_city' => $city_jabar_Depok->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Cimanggis',
            'id_province' => $city_jabar_Depok->id_province,
            'id_city' => $city_jabar_Depok->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Cinere',
            'id_province' => $city_jabar_Depok->id_province,
            'id_city' => $city_jabar_Depok->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Cipayung',
            'id_province' => $city_jabar_Depok->id_province,
            'id_city' => $city_jabar_Depok->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Limo',
            'id_province' => $city_jabar_Depok->id_province,
            'id_city' => $city_jabar_Depok->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Pancoran Mas',
            'id_province' => $city_jabar_Depok->id_province,
            'id_city' => $city_jabar_Depok->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Sawangan',
            'id_province' => $city_jabar_Depok->id_province,
            'id_city' => $city_jabar_Depok->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Sukmajaya',
            'id_province' => $city_jabar_Depok->id_province,
            'id_city' => $city_jabar_Depok->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Tapos',
            'id_province' => $city_jabar_Depok->id_province,
            'id_city' => $city_jabar_Depok->id,
        ));


        // kota bekasi
        $sub = SubdistrictList::create(array(
            'name' => 'Bantar Gebang',
            'id_province' => $city_jabar_Bekasi->id_province,
            'id_city' => $city_jabar_Bekasi->id,
        ));

        $sub = SubdistrictList::create(array(
            'name' => 'Bekasi Barat',
            'id_province' => $city_jabar_Bekasi->id_province,
            'id_city' => $city_jabar_Bekasi->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Bekasi Selatan',
            'id_province' => $city_jabar_Bekasi->id_province,
            'id_city' => $city_jabar_Bekasi->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Bekasi Timur',
            'id_province' => $city_jabar_Bekasi->id_province,
            'id_city' => $city_jabar_Bekasi->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Bekasi Utara',
            'id_province' => $city_jabar_Bekasi->id_province,
            'id_city' => $city_jabar_Bekasi->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Jatiasih',
            'id_province' => $city_jabar_Bekasi->id_province,
            'id_city' => $city_jabar_Bekasi->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Jatisampurna',
            'id_province' => $city_jabar_Bekasi->id_province,
            'id_city' => $city_jabar_Bekasi->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Medan Satria',
            'id_province' => $city_jabar_Bekasi->id_province,
            'id_city' => $city_jabar_Bekasi->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Mustika Jaya',
            'id_province' => $city_jabar_Bekasi->id_province,
            'id_city' => $city_jabar_Bekasi->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Pondok Gede',
            'id_province' => $city_jabar_Bekasi->id_province,
            'id_city' => $city_jabar_Bekasi->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Pondok Melati',
            'id_province' => $city_jabar_Bekasi->id_province,
            'id_city' => $city_jabar_Bekasi->id,
        ));
        
        $sub = SubdistrictList::create(array(
            'name' => 'Rawalumbu',
            'id_province' => $city_jabar_Bekasi->id_province,
            'id_city' => $city_jabar_Bekasi->id,
        ));
        
        PaymentType::create(['name' => 'Cash']);
        DB::table('daftar_barang_regulars')->delete();
        DB::table('daftar_barang_golds')->delete();
        DB::table('shipments')->delete();
        DB::table('slot_lists')->delete();

        $this->call(WeigthListSeeder::class);
        $this->call(PriceListSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(OfficeTypeTableSeeder::class);
        $this->call(InsuranceTableSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(PriceGoodsEstimateSeeder::class);
        $this->call(ShipmentStatusTableSeeder::class);
        $this->call(DeliveryStatusTableSeeder::class);
        $this->call(AirportSeeder::class);
        $this->call(FlightBookingSeeder::class);
        $this->call(MemberListSeeder::class);
        $this->call(TipsterMilestoneTableSeeder::class);
        $this->call(HelpTipsterSeeder::class);
        $this->call(AirportcityListTableSeeder::class);
        $this->call(YearPeriodSeeder::class);
        $this->call(MonthPeriodSeeder::class);
    }
}
