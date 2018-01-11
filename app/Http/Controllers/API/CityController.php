<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CityList;
use App\PriceList;
use App\AirportcityList;

class CityController extends Controller
{
    //
    function get_list() {
        $city_list = CityList::select('id', 'name')->get();

        $data = array(
            'err' => null,
            'result' => $city_list
        );

        return response()->json($data, 200);
    }

    function get_price(Request $request) {
        $id_origin_city = $request->id_origin_city;
        $id_destination_city = $request->id_destination_city;
        $price = PriceList::where('id_origin_city', $id_origin_city)->where('id_destination_city', $id_destination_city)->first();

        if($price == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Id city origin dan destination tidak ditemukan'
                ],
                'result' => null
            );
        } else {
            $data = array(
                'err' => null,
                'result' => [
                    'reguler' => (int) $price->tipster_price,
                    'gold' => $price->tipster_price + $price->add_first_class
                ]
            );
        }

        return response()->json($data, 200);
    }

    function get_airport_city_list() {
        $aiportcity = AirportcityList::all();
        $data = array(
            'err' => null,
            'result' => $aiportcity
        );

        return response()->json($data, 200);
    }
}
