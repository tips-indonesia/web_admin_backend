<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\WeightList;

class WeightController extends Controller
{
    //
    function get_list(Request $request) {
//        if($request->role == "Shipment") {
//            $weight_list = WeightList::where('for_shipment', true)->get();
//        } else {
//        }

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
}
