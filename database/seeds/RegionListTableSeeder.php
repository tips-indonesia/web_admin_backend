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
        $city = CityList::create(['name' => 'Bandung']);
        $city = CityList::create(['name' => 'Cirebon']);
        $city = CityList::create(['name' => 'Bogor']);
        $city = CityList::create(['name' => 'Medan']);
        $city = CityList::create(['name' => 'Kisaran']);
        $city = CityList::create(['name' => 'Pontianak']);
        $city = CityList::create(['name' => 'Singkawang']);
        $city = CityList::create(['name' => 'Kubu Raya']);

    
        $city = CityList::create(['name' => 'Baoding']);
        $city = CityList::create(['name' => 'Tangshan']);
    
        $city = CityList::create(['name' => 'Taiyuan']);
        $city = CityList::create(['name' => 'Datong']);
        $city = CityList::create(['name' => 'Changzhi']);
        $city = CityList::create(['name' => 'Changchun']);
        $city = CityList::create(['name' => 'Jilin']);
        $city = CityList::create(['name' => 'Siping']);

        $city = CityList::create(['name' => 'Dothan']);
        $city = CityList::create(['name' => 'Auburn']);
        $city = CityList::create(['name' => 'Mobile']);
        $city = CityList::create(['name' => 'Kodiak']);
        $city = CityList::create(['name' => 'Kenal']);
        $city = CityList::create(['name' => 'Sitka']);
        $city = CityList::create(['name' => 'Phoenix']);
        $city = CityList::create(['name' => 'Tucson']);
        $city = CityList::create(['name' => 'Mesa']);
    }
}
