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
        $price_list = PriceGoodsEstimate::all();
        $price_list_final = [];

        foreach ($price_list as $price) {
            array_push($price_list_final,(int) $price->price_estimate);
        }

        $data = array(
            'err' => null,
            'result' => $price_list_final
        );

        return response()->json($data, 200);
    }

    function get_list_weight() {
        $weight_list = WeightList::all();
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
        $insurance = Insurance::first();
        $data = array(
            'err' => null,
            'result' => array(
                'price' => $insurance->additional_insurance,
            )
        );

        return response()->json($data, 200);
    }
}
