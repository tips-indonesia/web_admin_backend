<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebScrapper extends Controller
{
	public function testScrapper($booking_code, $airport_code, $date, $first_name, $last_name){
		if(!$booking_code || !$airport_code || !$date || !$first_name || !$last_name)
			return "data booking_code, airport_code, date, first_name, atau last_name tidak boleh kosong";

		$res = WebScrapper::get_data($booking_code, $airport_code, $date, $first_name, $last_name);

		if($res){
			if($res->status == 404){
				$data = array(
		            'err' => $res,
		            'result' => null
		        );

		        return response()->json($data, 200); 
		    }else{
				$data = array(
		            'err' => null,
		            'result' => $res
		        );

		        return response()->json($data, 200); 
		    }
		}else{
	        $data = array(
	            'err' => [
	                "code"=> 500,
	                "message"=> "no response"
	            ],
	            'result' => null
	        );

	        return response()->json($data, 200);
		}
	}

	/**
	  * @param payload data
	  * @param destination -> dapat berupa token spesifik user atau topik
	  */
    public static function get_data($booking_code, $airport_code, $date, $first_name, $last_name){
		$url = "http://52.230.21.157/$booking_code/$airport_code/$date/$first_name/$last_name";
        $context  = stream_context_create(array(
        	'http' => array(
		    	'timeout' => 10 //seconds
		    )
		));
        $result = @file_get_contents($url, false, $context);
		return json_decode($result);
	}
}
