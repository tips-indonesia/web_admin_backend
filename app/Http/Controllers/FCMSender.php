<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FCMSender extends Controller
{

	public function testTopic(){
		FCMSender::post(array(
			'type' => "Delivery",
			'id' => "YPTR35P",
			'status' => "2",
			'message' => "Tes tes",
			'detail' => 'wkwkwk'
		), "cQBJ3VMAIwE:APA91bERNl6c2Dql2ZvT6P4ZoGkAaNnNSIvaimdmh3ICb3tDT2uIW02HtQVOzsQfL9Ib65HKWS-l-eMfNya_etBX8J6oQi0sujPVqFYhIu1u_K-d5XVnoZVHVPNtFoyM6KgrUiHXdVMM");
	}
	/**
	  * @param payload data
	  * @param destination -> dapat berupa token spesifik user atau topik
	  */
    public static function post($post_data, $destination){

		//example post data :
		// $content = array();
		// $content['title'] = "TEST TITLE";
		// $content['body'] = "TEST BODY";
		// $content['type'] = 1;
		// $content['timestamp'] = time();
		
		// echo '<pre>';print_r($post_data);exit;
		
		//example send to certain topic FCM 
		// $token = "/topics/foo-bar";
		
		//rules format topic
		// $topic = "project_".$id_project

		$data = array(
			'data'		=> $post_data,
			'priority'	=> 'high',
			'to'		=> $destination
		);
		
		$url = "https://fcm.googleapis.com/fcm/send";
        $opts = array('http' =>
            array(
                'method'  => 	'POST',
				'header'  =>  	"Content-Type:application/json'\r\n" .
								"Authorization: key=AAAA0PgLn_g:APA91bFtVGnDodw6phZsVQ03x11sDZCFdlC5eg0LoZHYM2d1h3rRw38J4OGNwinOUEMGJyl5VAiSNuEcp7giZQ9X2MZ8vSDnSgwKkP1M2WrPUTovRj7Leo4H7sTeBsVxCp8kiD6__0Jl\r\n",
				'content'  => 	json_encode($data)	
            )
        );
		
        $context  = stream_context_create($opts);
        $result = @file_get_contents($url, false, $context);
        if (strpos($http_response_header[0], '200') === false)
            return false;
		else
		    return true;
//			print_r($result);
	}
}
