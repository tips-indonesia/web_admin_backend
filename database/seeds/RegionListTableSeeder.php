<?php

use Illuminate\Database\Seeder;
use App\CountryList;
use App\ProvinceList;
use App\CityList;

class RegionListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $country = CountryList::create(['name' => 'Indonesia']);
            $province = ProvinceList::create(['name' => 'Jawa Barat', 'id_country' => $country->id]);
                $city = CityList::create(['name' => 'Bandung', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Cirebon', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Bogor', 'id_province' => $province->id]);
            $province = ProvinceList::create(['name' => 'Sumatra Utara', 'id_country' => $country->id]);
                $city = CityList::create(['name' => 'Medan', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Tanjungbalai', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Kisaran', 'id_province' => $province->id]);
            $province = ProvinceList::create(['name' => 'Kalimantan Barat', 'id_country' => $country->id]);
                $city = CityList::create(['name' => 'Pontianak', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Singkawang', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Kubu Raya', 'id_province' => $province->id]);

        $country = CountryList::create(['name' => 'China']);
            $province = ProvinceList::create(['name' => 'Heibei', 'id_country' => $country->id]);
                $city = CityList::create(['name' => 'Shijiazhuang', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Baoding', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Tangshan', 'id_province' => $province->id]);
            $province = ProvinceList::create(['name' => 'Shanxi', 'id_country' => $country->id]);
                $city = CityList::create(['name' => 'Taiyuan', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Datong', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Changzhi', 'id_province' => $province->id]);
            $province = ProvinceList::create(['name' => 'Jilin', 'id_country' => $country->id]);
                $city = CityList::create(['name' => 'Changchun', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Jilin', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Siping', 'id_province' => $province->id]);
        
        $country = CountryList::create(['name' => 'USA']);
            $province = ProvinceList::create(['name' => 'Alabama', 'id_country' => $country->id]);
                $city = CityList::create(['name' => 'Dothan', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Auburn', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Mobile', 'id_province' => $province->id]);
            $province = ProvinceList::create(['name' => 'Alaska', 'id_country' => $country->id]);
                $city = CityList::create(['name' => 'Kodiak', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Kenal', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Sitka', 'id_province' => $province->id]);
            $province = ProvinceList::create(['name' => 'Arizona', 'id_country' => $country->id]);
                $city = CityList::create(['name' => 'Phoenix', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Tucson', 'id_province' => $province->id]);
                $city = CityList::create(['name' => 'Mesa', 'id_province' => $province->id]);
    }
}
