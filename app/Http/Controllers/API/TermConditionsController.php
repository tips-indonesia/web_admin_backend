<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ConfigZ;

class TermConditionsController extends Controller
{
    //
    function index(){
    	$terms = null;
    	if (isset($_GET['type'])) {
    		$res = ConfigZ::where('key', $_GET['type'])->value('value');
    		$terms = array(
    			"value" => explode("<br />", $res),
    		);

    	} else {
        	$terms = ConfigZ::all();
        	foreach ($terms as $term) {
	        	$string = explode("<br />", $term->value);
	        	$term->value = $string;
	        }
        }
        $data = array(
            'err' => null,
            'result' => $terms
        );

        return response()->json($data, 200);
    }
}
