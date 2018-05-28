<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TIPSMailChimp extends Controller
{

	public static $STR_EMAIL_SENDER = "no-reply@tips.co.id";
	public static $STR_NAME_SENDER = "TIPS Administrator";
	public static $MANDRILL_API_KEY = "2Y3bxucbhBHL3zcMY76dOA";

	public static $TMP_RECEIPT = "E-Receipt Mail";
	public static $TMP_FORGOT_PASSWORD = "Forgot Password";
	public static $TMP_SHIPMENT_1 = "Transaction Mail Shipment-1";
	public static $TMP_SHIPMENT_2 = "Transaction Mail Shipment-2";
	public static $TMP_TIPSTER_1 = "Transaction Mail Tipster-1";
	public static $TMP_TIPSTER_2 = "Transaction Mail Tipster-2";
	public static $TMP_TIPSTER_3 = "Transaction Mail Tipster-3";
	public static $TMP_TIPSTER_4 = "Transaction Mail Tipster-4";
	public static $TMP_WELCOME = "Welcome Mail";

	public static function create_email_receiver($email, $name){
		return [
			"email" => $email,
			"name" => $name,
			"type" => "to"
		];
	}

	public static function create_template_data($name, $content){
		return [
			"name" => $name,
			"content" => $content
		];
	}

	public static function create_data($subject, $template_name, $template_data, $destinations){
		$data = [
			"key" => TIPSMailChimp::$MANDRILL_API_KEY,
			"template_name" => $template_name, 
			"template_content" => [], 
			"message" => [
				"html" => "",
				"text" => "",
				"merge" => true,
				"merge_language" => "mailchimp",
				"global_merge_vars" => $template_data,
				"subject" => $subject,
				"from_email" => TIPSMailChimp::$STR_EMAIL_SENDER,
				"from_name" => TIPSMailChimp::$STR_NAME_SENDER,
				"to" => $destinations
			]
		];

		return $data;
	}

    public static function send_chimp($subject, $template_name, $template_data, $destinations){
		$url = "https://mandrillapp.com/api/1.0/messages/send-template";
        $opts = [
        	'http' => [
                'method' => "POST",
				'header' => "Content-Type:application/json\r\n",
				'content' => json_encode(TIPSMailChimp::create_data($subject, $template_name, $template_data, $destinations))
            ]
        ];
		
        $context  = stream_context_create($opts);
        $result = @file_get_contents($url, false, $context);
        if(!isset($http_response_header))
        	return $result;

        if (strpos($http_response_header[0], '200') === false)
            return $result;
		else
		    return $result;
	}
}
