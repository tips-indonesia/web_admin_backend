<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PriceGoodsEstimate;
use App\WeightList;
use App\Insurance;

class GoodsController extends Controller
{
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
        $id_price_good_estimate = $request->id_price_estimate;
        if(!$id_price_estimate){
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

        $insurance = Insurance::first();
        $data = array(
            'err' => null,
            'result' => array(
                'price' => ($insurance->default_insurance / 100) * $price_data->nominal,
            )
        );

        return response()->json($data, 200);
    }
}
