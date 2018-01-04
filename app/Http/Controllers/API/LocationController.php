<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Province;
use App\City;
use App\Districts;

class LocationController extends Controller
{
    //

    function getProvince() {
        $provincies = Province::all();

        $data = array(
            'err' => null,
            'result' => $provincies
        );

        return response()->json($data, 200);
    }

    function getCity($id_province) {
        $cities = City::where('id_province', $id_province)->get();

        $data = array(
            'err' => null,
            'result' => $cities
        );

        return response()->json($data, 200);
    }

    function getDistrict($id_city) {
        $districts = Districts::where('id_city', $id_city)->get();

        $data = array(
            'err' => null,
            'result' => $districts
        );

        return response()->json($data, 200);
    }
}
