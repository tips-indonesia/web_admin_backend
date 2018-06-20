<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProvinceList;
use App\CityList;
use App\SubdistrictList;
//use App\Districts;

class LocationController extends Controller
{
    //

    function getProvince() {
        $provincies = ProvinceList::all();

        $data = array(
            'err' => null,
            'result' => $provincies
        );

        return response()->json($data, 200);
    }

    function getCity($id_province) {
        $cities = CityList::where('id_province', $id_province)->get();

        $data = array(
            'err' => null,
            'result' => $cities
        );

        return response()->json($data, 200);
    }

    function getDistrict($id_city) {
        $districts = SubdistrictList::where('id_city', $id_city)->get();

        $data = array(
            'err' => null,
            'result' => $districts
        );

        return response()->json($data, 200);
    }

    function get_all_province(){
        return ProvinceList::all();
    }

    function get_all_city(){
        return CityList::all();
    }

    function get_all_subdistrict(){
        return SubdistrictList::all();
    }
}
