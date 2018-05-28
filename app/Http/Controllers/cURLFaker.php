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
    public function sendMailRegistration($email, $NAMA){
        $receivers = [TIPSMailChimp::create_email_receiver($email, $NAMA)];
        return TIPSMailChimp::send_chimp(
            "TIPS Registration, Hi $NAMA",
            TIPSMailChimp::$TMP_WELCOME,
            [],
            $receivers
        );
        // exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'registration' 'email' '$email' 'NAMA' '$NAMA' >> /var/www/html/tips/zz/logcurlx.txt > /dev/null 2>&1 &");
    }
    // ------------------------------
    // ##############################

    // ------------------------------
    //
    // INI BAGIAN EMAIL UNTUK TIPSTER
    //
    // --
    public function sendMailTipsterStep1($email, $NAMA, $ANTAR_CODE){
        $receivers = [TIPSMailChimp::create_email_receiver($email, $NAMA)];
        TIPSMailChimp::send_chimp(
            "TIPS: $NAMA, penerbangan Anda telah terdaftar $ANTAR_CODE",
            TIPSMailChimp::$TMP_TIPSTER_1,
            [
                TIPSMailChimp::create_template_data('STR_NAMA', $NAMA),
            ],
            $receivers
        );
        // exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'antar' 'code' '1' 'email' '$email' 'NAMA' '$NAMA' 'ANTAR_CODE' '$ANTAR_CODE' >> /var/www/html/tips/zz/logcurlx.txt > /dev/null 2>&1 &");
    }

    public function sendMailTipsterStep2($email, $NAMA, $ANTAR_CODE, $JAM_TANGGAL){
        $receivers = [TIPSMailChimp::create_email_receiver($email, $NAMA)];
        TIPSMailChimp::send_chimp(
            "TIPS: $NAMA, barang antaran untuk penerbangan $ANTAR_CODE telah tersedia",
            TIPSMailChimp::$TMP_TIPSTER_2,
            [
                TIPSMailChimp::create_template_data('STR_NAMA', $NAMA),
                TIPSMailChimp::create_template_data('STR_SHIPPING_CODE', $ANTAR_CODE),
                TIPSMailChimp::create_template_data('DTM_JAM_TANGGAL_KONFIRMASI', $JAM_TANGGAL),
            ],
            $receivers
        );
    	// exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'antar' 'code' '2' 'email' '$email' 'NAMA' '$NAMA' 'ANTAR_CODE' '$ANTAR_CODE' 'JAM_TANGGAL' '$JAM_TANGGAL' >> /var/www/html/tips/zz/logcurlx.txt > /dev/null 2>&1 &");
    }

    public function sendMailTipsterStep3($email, $NAMA, $ANTAR_CODE, $ORIGIN_AIRPORT_NAME, $_3HOURS_DEPARTURE_TIME, $NOMOR_CALL_CENTER){
        $receivers = [TIPSMailChimp::create_email_receiver($email, $NAMA)];
        TIPSMailChimp::send_chimp(
            "TIPS: $NAMA, penerbangan $ANTAR_CODE telah terkonfirmasi, harap tiba di bandara 4 jam sebelum penerbangan",
            TIPSMailChimp::$TMP_TIPSTER_3,
            [
                TIPSMailChimp::create_template_data('STR_NAMA', $NAMA),
                TIPSMailChimp::create_template_data('STR_SHIPPING_CODE', $ANTAR_CODE),
                TIPSMailChimp::create_template_data('STR_ORIGIN_AIRPORT_NAME', $ORIGIN_AIRPORT_NAME),
                TIPSMailChimp::create_template_data('TME_4HOURS_DEPARTURE_TIME', $_3HOURS_DEPARTURE_TIME),
                TIPSMailChimp::create_template_data('STR_NOMOR_CALL_CENTER', $NOMOR_CALL_CENTER),
            ],
            $receivers
        );
        // exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'antar' 'code' '3' 'email' '$email' 'NAMA' '$NAMA' 'ANTAR_CODE' '$ANTAR_CODE' 'ORIGIN_AIRPORT_NAME' '$ORIGIN_AIRPORT_NAME' '_3HOURS_DEPARTURE_TIME' '$_3HOURS_DEPARTURE_TIME' 'NOMOR_CALL_CENTER' '$NOMOR_CALL_CENTER' >> /var/www/html/tips/zz/logcurlx.txt > /dev/null 2>&1 &");
    }

    public function sendMailTipsterStep7($email, $NAMA){
        $receivers = [TIPSMailChimp::create_email_receiver($email, $NAMA)];
        TIPSMailChimp::send_chimp(
            "TIPS: $NAMA, terima kasih atas kerja sama Anda.",
            TIPSMailChimp::$TMP_TIPSTER_4,
            [
                TIPSMailChimp::create_template_data('STR_NAMA', $NAMA),
            ],
            $receivers
        );
        // exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'antar' 'code' '7' 'email' '$email' 'NAMA' '$NAMA' >> /var/www/html/tips/zz/logcurlx.txt > /dev/null 2>&1 &");
    }
    // ------------------------------
    // ##############################


    // ------------------------------
    //
    // INI BAGIAN EMAIL UNTUK SHIPPER
    //
    // --
    public function sendMailShipperStep1($email, $NAMA, $SHIPPING_CODE, $NOMOR_CALL_CENTER){
        $receivers = [TIPSMailChimp::create_email_receiver($email, $NAMA)];
        TIPSMailChimp::send_chimp(
            "TIPS: $NAMA, pengiriman Anda telah terdaftar dengan kode $SHIPPING_CODE",
            TIPSMailChimp::$TMP_SHIPMENT_1,
            [
                TIPSMailChimp::create_template_data('STR_NAMA', $NAMA),
                TIPSMailChimp::create_template_data('STR_SHIPPING_CODE', $SHIPPING_CODE),
                TIPSMailChimp::create_template_data('STR_NOMOR_CALL_CENTER', $NOMOR_CALL_CENTER),
            ],
            $receivers
        );
        // exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'kirim' 'code' '1' 'email' '$email' 'NAMA' '$NAMA' 'SHIPPING_CODE' '$SHIPPING_CODE' 'NOMOR_CALL_CENTER' '$NOMOR_CALL_CENTER' >> /var/www/html/tips/zz/logcurlx.txt > /dev/null 2>&1 &");
    }

    public function sendMailShipperStep8($email, $NAMA, $SHIPPING_CODE, $RECIPIENT_NAME){
        $receivers = [TIPSMailChimp::create_email_receiver($email, $NAMA)];
        TIPSMailChimp::send_chimp(
            "TIPS: $NAMA, paket kiriman $SHIPPING_CODE Anda telah diterima oleh $RECIPIENT_NAME",
            TIPSMailChimp::$TMP_SHIPMENT_2,
            [
                TIPSMailChimp::create_template_data('STR_NAMA', $NAMA),
                TIPSMailChimp::create_template_data('STR_SHIPPING_CODE', $SHIPPING_CODE),
                TIPSMailChimp::create_template_data('STR_RECIPIENT_NAME', $RECIPIENT_NAME),
            ],
            $receivers
        );
        // exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'kirim' 'code' '8' 'email' '$email' 'NAMA' '$NAMA' 'SHIPPING_CODE' '$SHIPPING_CODE' 'RECIPIENT_NAME' '$RECIPIENT_NAME' >> /var/www/html/tips/zz/logcurlx.txt > /dev/null 2>&1 &");
    }
    // ------------------------------
    // ##############################
}
