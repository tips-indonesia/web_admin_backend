<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PriceGoodsEstimate;
use App\WeightList;
use App\PriceList;
use App\Insurance;

class GoodsController extends Controller
{

    function get_city_price_list($id_origin_city, $id_destination_city){
        $price = PriceList::where('id_origin_city', $id_origin_city)
                            ->where('id_destination_city', $id_destination_city)
                            ->first();

        if(!$price){
            $data = array(
                'err' => [
                    "code" => 404,
                    "message" => "Price list tidak ditemukan"
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        $price->originCity;
        $price->destinationCity;

        $data = array(
            'err' => null,
            'result' => array(
                'data' => $price
            )
        );

        return response()->json($data, 200);
    }
    //
    function get_list_price_estimate() {
        $price_list = PriceGoodsEstimate::select('id', 'price_estimate')->get();


        $data = array(
            'err' => null,
            'result' => array(
                'price_list' => $price_list
            )
        );

        return response()->json($data, 200);
    }

    function get_list_weight(Request $request) {
        if($request->role == "Shipment") {
            $weight_list = WeightList::where('for_shipment', true)->get();
        } else {
            $weight_list = WeightList::where('for_delivery', true)->get();
        }
        $weight_list_final = [];

        foreach ($weight_list as $weight) {
            array_push($weight_list_final, $weight->weight_kg);
        }

        $data = array(
            'err' => null,
            'result' => $weight_list_final
        );

        return response()->json($data, 200);
    }

    function get_insurance_price(Request $request) {
        $id_user = $request->id_user;
        $id_price_good_estimate = $request->id_price_estimate;
        if(!$id_price_good_estimate){
            $data = array(
                'err' => null,
                'result' => array(
                    'price' => 0,
                )
            );

            return response()->json($data, 200);
        }

        $price_data = PriceGoodsEstimate::find($id_price_good_estimate);
        if(!$price_data){
            $data = array(
                'err' => null,
                'result' => array(
                    'price' => 0,
                )
            );

            return response()->json($data, 200);
        }

        // NEW API, optional for back compability
        $ratio_discount = 0.0;
        if($id_user){
            $promotion_available = PromotionController::getUserPromoOrNULL($id_user);
            if($promotion_available['promo'] != null)
                $ratio_discount = $promotion_available['promo']->discount_value / 100;
        }

        $insurance = Insurance::first();
        $insurance_price = ($insurance->default_insurance / 100) * $price_data->nominal;
        $data = array(
            'err' => null,
            'result' => array(
                'price' => $insurance_price,
                'addt_info' => [
                    'discount' => (double) ($insurance_price * $ratio_discount)
                ]
            )
        );

        return response()->json($data, 200);
    }
}
