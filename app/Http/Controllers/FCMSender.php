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
			'detail' => 'wkwkwk',
			"alert" => "Breaking News!",
			// "content_available" => true,
			"sound" => "default",
			"link_url" => "https://raywenderlich.com"
		), "e_qN6JnRCd0:APA91bGB-VPOEO3XwJOxFJZkAsnj9_A8ZnOfU8UIcvUzHBI0IfyK7A8IbBF3Rb-3scw5STFHVLubdOeRBoHoJtxDBJfzomGabsrTGDz334BKbZ6ftbzq3f1sQAEwBS1teZYTeGRd20vxD5OJZ4AUOle4RC2yzY1Xng");
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
			// 'content_available' => true,
			'mutable-content'	=> true,
			'data'				=> $post_data,
			'priority'			=> 'high',
			"notification" => [
				"body" => $post_data["message"],
				"title" => $post_data["type"],
				"icon" => "myicon"
			],
			'to'				=> $destination
		);
		
		$url = "https://fcm.googleapis.com/fcm/send";
        $opts = array('http' =>
            array(
                'method'  => 	'POST',
				'header'  =>  	"Content-Type:application/json'\r\n" .
								"Authorization: key=AAAAoFTtcDo:APA91bHmbaxP6xagcmKIe1Kvu5R4AsiSAVlTIMs48Hrd_soCY59rhELnJgjr6VGM46O1BsjYEGOKqMD4iiVwivwJ1h1sCH1nUba1lhg4Z83ha-k7Bi85CLTy4SbN8BB3HOzCZ8XoTJyJ\r\n",
				'content'  => 	json_encode($data)	
            )
        );
		
        $context  = stream_context_create($opts);
        $result = @file_get_contents($url, false, $context);
        if(!isset($http_response_header))
        	return false;

        if (strpos($http_response_header[0], '200') === false)
            return false;
		else
		    return true;
//			print_r($result);
	}
}
