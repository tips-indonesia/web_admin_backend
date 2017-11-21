<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FCMSender extends Controller
{

	public function testTopic(){
		FCMSender::post(array(
			'code' => 200,
			'text' => "hahahaha"
		), "/topics/tipster");
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
								"Authorization: key=AAAA0PgLn_g:APA91bHI5dueNJ1XTea8zQNzSt1Opmd9viRAJv8xGG-tjifKJukqsb1C8CE9W5jyXtVHdfD4exj0I_cTiuIvaud6EQLux-mOhMXA_9Ql7lfYkTCdiwkM9qEWxbOFYOdn7ti-XTfy4_Og\r\n",
				'content'  => 	json_encode($data)	
            )
        );
		
        $context  = stream_context_create($opts);
        $result = @file_get_contents($url, false, $context);
        if (strpos($http_response_header[0], '200') === false)
            return false;
		else
			print_r($result);
	}
}
