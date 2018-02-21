<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CityList;
use App\PriceList;
use App\AirportcityList;
use App\Insurance;

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
        $insurance = Insurance::first();

        if($price == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Id city origin dan destination tidak ditemukan'
                ],
                'result' => null
            );
        } else {
            $reguler = $price->freight_cost + (($price->freight_cost * $insurance->default_insurance) /100);
            $gold = $price->freight_cost + $price->add_first_class;
            $gold = $gold + (($gold * $insurance->default_insurance) /100);

            $reguler = $this->round_nearest_hundreds($reguler);
            $gold = $this->round_nearest_hundreds($gold);

            $data = array(
                'err' => null,
                'result' => [
                    'reguler' => (int) $reguler,
                    'gold' => (int) $gold
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

    function round_nearest_hundreds($number) {
        $number = round($number);
        if($number % 100 == 0) {
            return $number;
        } else {
            $number = (round($number / 100) + 1) * 100;
            return $number;
        }
    }
}
