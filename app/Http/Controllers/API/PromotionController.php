<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promotion;
use App\Banner;
use Illuminate\Support\Facades\URL;
use DB;

class PromotionController extends Controller
{
    public function getPromo() {
    	if (isset($_GET['id_user'])) {
    		// Dunno what to do
    	} else {
    		// Dunno what to do
    	}

    	$promos = DB::table('promotions')->get();
    	$res = array();
    	foreach($promos as $promo) {
    		$dum = [
    			'id' => $promo->id,
                'start_date' => $promo->start_date,
                'end_date' => $promo->end_date,
                'header' => $promo->header,
                'template_type' => $promo->template_type,
                'discount' => $promo->discount_value,
    			'img_src' => URL::to('storage/promotions/'.$promo->file_name),
    		];
    		array_push($res, $dum);
    	}

    	$data = array(
    		'err' => null,
    		'result' => [
    			'promo' => $res,
    		]
    	);

    	return response()->json($data, 200);
    }

    // public function getIklan() {
    // 	if (isset($_GET['id_user'])) {
    // 		// Dunno what to do
    // 	} else {
    // 		// Dunno what to do
    // 	}

    // 	$iklans = Banner::all();
    // 	$res = array();

    //     foreach($iklans as $promo) {
    //         $dum = [
    //             'id' => $promo->id,
    //             'start_date' => $promo->start_date,
    //             'end_date' => $promo->end_date,
    //             'header' => $promo->header,
    //             'template_type' => $promo->template_type,
    //             'discount' => $promo->discount,
    //             'img_src' => URL::to('storage/promotions/'.$promo->filename),
    //         ];
    //         array_push($res, $dum);
    //     }

    // 	$data = array(
    // 		'err' => null,
    // 		'result' => [
    // 			'iklan' => $res
    // 		]
    // 	);

    // 	return response()->json($data, 200);	
    // }
}
