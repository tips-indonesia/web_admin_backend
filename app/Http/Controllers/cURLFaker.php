<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cURLFaker extends Controller
{
    public function test_command(Request $req){
    	return exec($req->command);
    }

    // ------------------------------
    //
    // INI BAGIAN EMAIL UNTUK TIPSTER
    //
    // --
    public function sendMailTipsterStep1($email, $NAMA, $ANTAR_CODE){
        exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'antar' 'code' '1' 'email' '$email' 'NAMA' '$NAMA' 'ANTAR_CODE' '$ANTAR_CODE' >> logcurl.txt");
    }

    public function sendMailTipsterStep2($email, $NAMA, $ANTAR_CODE, $JAM_TANGGAL){
    	exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'antar' 'code' '2' 'email' '$email' 'NAMA' '$NAMA' 'ANTAR_CODE' '$ANTAR_CODE' 'JAM_TANGGAL' '$JAM_TANGGAL' >> logcurl.txt");
    }

    public function sendMailTipsterStep3($email, $NAMA, $ANTAR_CODE, $ORIGIN_AIRPORT_NAME, $_3HOURS_DEPARTURE_TIME, $NOMOR_CALL_CENTER){
        exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'antar' 'code' '3' 'email' '$email' 'NAMA' '$NAMA' 'ANTAR_CODE' '$ANTAR_CODE' 'ORIGIN_AIRPORT_NAME' '$ORIGIN_AIRPORT_NAME' '_3HOURS_DEPARTURE_TIME' '$_3HOURS_DEPARTURE_TIME' 'NOMOR_CALL_CENTER' '$NOMOR_CALL_CENTER' >> logcurl.txt");
    }

    public function sendMailTipsterStep7($email, $NAMA){
        exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'antar' 'code' '7' 'email' '$email' 'NAMA' '$NAMA' >> logcurl.txt");
    }
    // ------------------------------
    // ##############################


    // ------------------------------
    //
    // INI BAGIAN EMAIL UNTUK SHIPPER
    //
    // --
    public function sendMailShipperStep1($email, $NAMA, $SHIPPING_CODE, $NOMOR_CALL_CENTER){
        exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'kirim' 'code' '1' 'email' '$email' 'NAMA' '$NAMA' 'SHIPPING_CODE' '$SHIPPING_CODE' 'NOMOR_CALL_CENTER' '$NOMOR_CALL_CENTER' >> logcurl.txt");
    }

    public function sendMailShipperStep8($email, $NAMA, $SHIPPING_CODE, $RECIPIENT_NAME){
        exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'kirim' 'code' '8' 'email' '$email' 'NAMA' '$NAMA' 'SHIPPING_CODE' '$SHIPPING_CODE' 'RECIPIENT_NAME' '$RECIPIENT_NAME' >> logcurl.txt");
    }
    // ------------------------------
    // ##############################
}
