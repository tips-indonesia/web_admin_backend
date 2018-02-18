<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ConfigZ;

class TermConditionsController extends Controller
{
    //
    function index(){
        $terms = ConfigZ::all();
        $data = array(
            'err' => null,
            'result' => $terms
        );
        foreach ($terms as $term) {
        	$string = explode("<br>", $term->value);
        	$term->value = $string;
        }
        return response()->json($data, 200);
    }
}
