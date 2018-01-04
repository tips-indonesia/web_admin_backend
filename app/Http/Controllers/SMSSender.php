<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSSender extends Controller
{

	public function testSMS(Request $request){
		if(!$request->nohp || !$request->pesan)
			return "nohp atau pesan tidak boleh kosong";

		SMSSender::kirim($request->nohp, $request->pesan);
	}

	/**
	  * @param payload data
	  * @param destination -> dapat berupa token spesifik user atau topik
	  */
    public static function kirim($nohp, $pesan){
		$url = "https://reguler.zenziva.net/apps/smsapi.php?userkey=4zrqsh&passkey=123&nohp=$nohp&pesan=$pesan";
        $context  = stream_context_create();
        $result = @file_get_contents($url, false, $context);
		return $result;
	}
}
