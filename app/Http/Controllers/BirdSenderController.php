<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\MemberList;

class BirdSenderController extends Controller
{
    public static function sendEmail($mail, $subject, $template, $hashMapBodyTemplate){
        Mail::send($template, $hashMapBodyTemplate, function ($message) use( &$mail, &$subject) {
            $message->from('no-reply@tips.co.id', 'Tips Official');
            $message->to($mail)->subject($subject);
        });

        $data = array(
            'err' => null,
            'result' => "email berhasil dikirim"
        );

        return response()->json($data, 200);
    }

    public function sendReportMail(Request $req){
    	$user 			= MemberList::find($req->id);
    	if(!$user){
    		$data = array(
	            'err' => null,
	            'result' => "user tidak ditemukan"
	        );

	        return response()->json($data, 200);
    	}
    	$destination    = "riochr17@gmail.com";
        $subject        = "Tips Support";
        $template       = "mail.bantuan";
        $timezone 		= "Asia/Jakarta";
        date_default_timezone_set($timezone);
		$datetime 		= date("d-m-Y h:i:sa");
        $data           = [
            "user" 	=> $user,
            "topic"	=> $req->topik,
            "data"	=> $req->data,
            "datetime" => $datetime,
            "timezone" => $timezone
        ];
        return BirdSenderController::sendEmail($destination, $subject, $template, $data);
    }

    public function sendRegistrationMail($id){
        $user = MemberList::find($id);
        if(!$user){
            $data = array(
                "err" => "user tidak ditemukan",
                "result" => null
            );

            return response()->json($data, 404);
        }

        $destination    = $user->email;
        $subject        = "Mail Registration Tips";
        $template       = "mail.registration";
        $timezone       = "Asia/Jakarta";
        $datetime       = date("d-m-Y h:i:sa");
        $data           = [
            "user"     => $user,
            "datetime" => $datetime,
            "timezone" => $timezone
        ];

        return BirdSenderController::sendEmail($destination, $subject, $template, $data);
    }

    public function sendResetPasswordMail(Request $req){
        if(!$req->email){
            $data = array(
                "err" => [
                    "code" => 500,
                    "message" => "parameter email wajib diisi"
                ],
                "result" => null
            );

            return response()->json($data, 200);
        }

        $user = MemberList::where('email', $req->email)->first();

        if(!$user){
            $data = array(
                "err" => [
                    "code" => 404,
                    "message" => "user tidak ditemukan"
                ],
                "result" => null
            );

            return response()->json($data, 200);
        }

        $destination    = $user->email;
        $subject        = "Mail Registration Tips";
        $template       = "mail.forgot_password";
        $timezone       = "Asia/Jakarta";
        $datetime       = date("d-m-Y h:i:sa");
        $data           = [
            "user"     => $user,
            "datetime" => $datetime,
            "timezone" => $timezone
        ];

        return BirdSenderController::sendEmail($destination, $subject, $template, $data);
    }

    public function testMail(Request $req){
        $destination    = "riochr17@gmail.com";
        $subject        = "Test Emal Tips";
        $template       = "mail.tes";
        $data           = [
            "nama" => "Rio"
        ];
        return BirdSenderController::sendEmail($destination, $subject, $template, $data);
    }
}
