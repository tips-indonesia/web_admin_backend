<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promotion;
use App\Banner;
use Illuminate\Support\Facades\URL;

class PromotionController extends Controller
{
    public function getPromo() {
    	if (isset($_GET['id_user'])) {
    		// Dunno what to do
    	} else {
    		// Dunno what to do
    	}

    	$promos = Promotion::all();
    	$res = array();

    	foreach($promos as $promo) {
    		$dum = [
    			'id' => $promo->id,
    			'img_src' => URL::to('storage/promotions/'.$promo->filename),
    			'title' => $promo->title,
    			'description' => $promo->description
    		];
    		array_push($res, $dum);
    	}

    	$data = array(
    		'err' => null,
    		'result' => $res
    	);

    	return response()->json($data, 200);
    }

    public function getIklan() {
    	if (isset($_GET['id_user'])) {
    		// Dunno what to do
    	} else {
    		// Dunno what to do
    	}

    	$iklans = Banner::all();
    	$res = array();

    	foreach($iklans as $iklan) {
    		$dum = [
    			'id' => $iklan->id,
    			'img_src' => URL::to('storage/banners/'.$iklan->filename),
    			'title' => $iklan->title,
    			'description' => $iklan->description
    		];
    		array_push($res, $dum);
    	}

    	$data = array(
    		'err' => null,
    		'result' => $res
    	);

    	return response()->json($data, 200);	
    }
}
