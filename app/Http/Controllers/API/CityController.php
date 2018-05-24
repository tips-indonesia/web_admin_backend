<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CityList;
use App\PriceList;
use App\AirportcityList;
use App\Insurance;
use App\Http\Controllers\API\PromotionController;

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
        $id_user = $request->id_user;
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
            // $reguler = $price->freight_cost + (($price->freight_cost * $insurance->default_insurance) /100);
            // revised below
            $reguler = $price->freight_cost;
            $gold = $price->freight_cost + $price->add_first_class;
            $gold = $gold + (($gold * $insurance->default_insurance) /100);
            $discount = 0;

            // NEW API, optional for back compability
            if($id_user){
                $promotion_available = PromotionController::getUserPromoOrNULL($id_user);
                if($promotion_available['promo'] != null)
                    $discount = $reguler * ($promotion_available['promo']->discount_value / 100);
            }

            $reguler = $this->round_nearest_hundreds($reguler);
            $gold = $this->round_nearest_hundreds($gold);

            $reguler -= 
            $gold -= 

            $data = array(
                'err' => null,
                'result' => [
                    'reguler' => (int) $reguler,
                    'gold' => (int) $gold,
                    'addt_info' => [
                        'discount' => (double) $discount
                    ]
                ]
            );
        }

        return response()->json($data, 200);
    }

    function get_price_v2(Request $request) {
        $id_user = $request->id_user;
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
            // $reguler = $price->freight_cost + (($price->freight_cost * $insurance->default_insurance) /100);
            // revised below
            $reguler = $price->freight_cost;
            $gold = $price->freight_cost + $price->add_first_class;
            $gold = $gold + (($gold * $insurance->default_insurance) /100);
            $discount = 0;

            // NEW API, optional for back compability
            if($id_user){
                $promotion_available = PromotionController::getUserPromoOrNULL($id_user);
                if($promotion_available['promo'] != null)
                    $discount = $promotion_available['promo']->discount_value / 100;
            }

            $reguler = $this->round_nearest_hundreds($reguler);
            $gold = $this->round_nearest_hundreds($gold);

            $reguler -= $reguler * $discount;
            $gold -= $gold * $discount;

            $data = array(
                'err' => null,
                'result' => [
                    'reguler' => (int) $reguler,
                    'gold' => (int) $gold,
                    'addt_info' => [
                        'discount' => (double) -1.0
                    ]
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
