<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ConfigZ;

class PromotionTextController extends Controller
{
    public function index() {
    	$conf = ConfigZ::find(5);
    	$data['text'] = $conf->value;
    	return view('admin.promotiontext.index', $data);
    }

    public function store(Request $req) {
    	$conf = ConfigZ::find(5);

    	if ($req->input('submit') == 'save') {
	    	$conf->value = $req->input('promotion_text');
	    } else if ($req->input('submit') == 'clear') {
	    	$conf->value = ' ';
	    }

    	$conf->save();
    	return back();
    }
}
