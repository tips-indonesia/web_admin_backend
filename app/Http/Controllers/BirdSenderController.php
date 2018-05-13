<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\MemberList;
use App\Http\Controllers\cURLFaker;

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
        date_default_timezone_set($timezone);
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

        $user->reset_password_token = hash('sha512', $user->password . uniqid());
        $user->save();
        $destination    = $user->email;
        $subject        = "Mail Registration Tips";
        $template       = "mail.forgot_password";
        $timezone       = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $datetime       = date("d-m-Y h:i:sa");
        $data           = [
            "user"     => $user,
            "datetime" => $datetime,
            "timezone" => $timezone
        ];

        return BirdSenderController::sendEmail($destination, $subject, $template, $data);
    }

    public function testMail(Request $req){
        // $destination    = "riochr17@gmail.com";
        // $subject        = "Test Emal Tips";
        // $template       = "mail.tes";
        // $data           = [
        //     "nama" => "Rio"
        // ];
        // return BirdSenderController::sendEmail($destination, $subject, $template, $data);
        // $this->sendMailRegistration("riochr17@gmail.com", "Rio0000");

        $bsc = new cURLFaker;
        $email = "riochr17@gmail.com";
        $nama = 'Rio riorio';
        $bsc->sendMailRegistration($email, $nama);
    }

    public function sendMailRegistration($email, $NAMA){
        $destination    = $email;
        $subject        = "TIPS Registration, Hi $NAMA";
        $template       = "mail.register";
        $timezone       = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $datetime       = date("d-m-Y h:i:sa");
        $data           = [
            "NAMA"     => $NAMA,

            // field wajib
            "datetime" => $datetime,
            "timezone" => $timezone
        ];

        return BirdSenderController::sendEmail($destination, $subject, $template, $data);
    }

    // ------------------------------
    //
    // INI BAGIAN EMAIL UNTUK TIPSTER
    //
    // --
    public function sendMailTipsterStep1($email, $NAMA, $ANTAR_CODE){
        $destination    = $email;
        $subject        = "TIPS: $NAMA, penerbangan Anda telah terdaftar $ANTAR_CODE";
        $template       = "mail.tipster.step1";
        $timezone       = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $datetime       = date("d-m-Y h:i:sa");
        $data           = [
            "NAMA"     => $NAMA,

            // field wajib
            "datetime" => $datetime,
            "timezone" => $timezone
        ];

        return BirdSenderController::sendEmail($destination, $subject, $template, $data);
    }

    public function sendMailTipsterStep2($email, $NAMA, $ANTAR_CODE, $JAM_TANGGAL){
        $destination    = $email;
        $subject        = "TIPS: $NAMA, barang antaran untuk penerbangan $ANTAR_CODE telah tersedia";
        $template       = "mail.tipster.step2";
        $timezone       = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $datetime       = date("d-m-Y h:i:sa");
        $data           = [
            "NAMA"     => $NAMA,
            "JAM_TANGGAL" => $JAM_TANGGAL,

            // field wajib
            "datetime" => $datetime,
            "timezone" => $timezone
        ];

        return BirdSenderController::sendEmail($destination, $subject, $template, $data);
    }

    public function sendMailTipsterStep3($email, $NAMA, $ANTAR_CODE, $ORIGIN_AIRPORT_NAME, $_3HOURS_DEPARTURE_TIME, $NOMOR_CALL_CENTER){
        $destination    = $email;
        $subject        = "TIPS: $NAMA, penerbangan $ANTAR_CODE telah terkonfirmasi, harap tiba di bandara 3 jam sebelum penerbangan";
        $template       = "mail.tipster.step3";
        $timezone       = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $datetime       = date("d-m-Y h:i:sa");
        $data           = [
            "NAMA"     => $NAMA,
            "ORIGIN_AIRPORT_NAME" => $ORIGIN_AIRPORT_NAME,
            "_3HOURS_DEPARTURE_TIME" => $_3HOURS_DEPARTURE_TIME,
            "NOMOR_CALL_CENTER" => $NOMOR_CALL_CENTER,

            // field wajib
            "datetime" => $datetime,
            "timezone" => $timezone
        ];

        return BirdSenderController::sendEmail($destination, $subject, $template, $data);
    }

    public function sendMailTipsterStep7($email, $NAMA){
        $destination    = $email;
        $subject        = "TIPS: $NAMA, terima kasih atas kerja sama Anda.";
        $template       = "mail.tipster.step7";
        $timezone       = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $datetime       = date("d-m-Y h:i:sa");
        $data           = [
            "NAMA"     => $NAMA,

            // field wajib
            "datetime" => $datetime,
            "timezone" => $timezone
        ];

        return BirdSenderController::sendEmail($destination, $subject, $template, $data);
    }
    // ------------------------------
    // ##############################


    // ------------------------------
    //
    // INI BAGIAN EMAIL UNTUK SHIPPER
    //
    // --
    public function sendMailShipperStep1($email, $NAMA, $SHIPPING_CODE, $NOMOR_CALL_CENTER){
        $destination    = $email;
        $subject        = "TIPS: $NAMA, pengiriman Anda telah terdaftar dengan kode $SHIPPING_CODE";
        $template       = "mail.shipper.step1";
        $timezone       = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $datetime       = date("d-m-Y h:i:sa");
        $data           = [
            "NAMA"     => $NAMA,
            "SHIPPING_CODE" => $SHIPPING_CODE,
            "NOMOR_CALL_CENTER" => $NOMOR_CALL_CENTER,

            // field wajib
            "datetime" => $datetime,
            "timezone" => $timezone
        ];

        return BirdSenderController::sendEmail($destination, $subject, $template, $data);
    }

    public function sendMailShipperStep8($email, $NAMA, $SHIPPING_CODE, $RECIPIENT_NAME){
        $destination    = $email;
        $subject        = "TIPS: $NAMA, paket kiriman $SHIPPING_CODE Anda telah diterima oleh $RECIPIENT_NAME";
        $template       = "mail.shipper.step8";
        $timezone       = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $datetime       = date("d-m-Y h:i:sa");
        $data           = [
            "NAMA"     => $NAMA,
            "SHIPPING_CODE" => $SHIPPING_CODE,
            "RECIPIENT_NAME" => $RECIPIENT_NAME,

            // field wajib
            "datetime" => $datetime,
            "timezone" => $timezone
        ];

        return BirdSenderController::sendEmail($destination, $subject, $template, $data);
    }
    // ------------------------------
    // ##############################

    public function APIEmailSender(Request $req){
        if($req->type == 'registration'){
            $this->sendMailRegistration($req->email, $req->NAMA);
        }

        if($req->type == 'antar'){
            $code = $req->code;
            switch ($code) {
                case '1':
                    $this->sendMailTipsterStep1($req->email, $req->NAMA, $req->ANTAR_CODE);
                    break;
                case '2':
                    $this->sendMailTipsterStep2($req->email, $req->NAMA, $req->ANTAR_CODE, $req->JAM_TANGGAL);
                    break;
                case '3':
                    $this->sendMailTipsterStep3($req->email, $req->NAMA, $req->$ORIGIN_AIRPORT_NAME, 
                                                $req->_3HOURS_DEPARTURE_TIME, $req->NOMOR_CALL_CENTER);
                    break;
                case '7':
                    $this->sendMailTipsterStep7($req->email, $req->NAMA);
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        if($req->type == 'kirim'){
            $code = $req->code;
            switch ($code) {
                case '1':
                    $this->sendMailShipperStep1($req->email, $req->NAMA, $req->SHIPPING_CODE, $req->NOMOR_CALL_CENTER);
                    break;
                case '8':
                    $this->sendMailShipperStep8($req->email, $req->NAMA, $req->SHIPPING_CODE, $req->RECIPIENT_NAME);
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
}
