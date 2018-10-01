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
            [
                TIPSMailChimp::create_template_data('STR_NAMA', $NAMA),
            ],
            $receivers
        );
        // exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'registration' 'email' '$email' 'NAMA' '$NAMA' >> /var/www/html/tips/zz/logcurlx.txt > /dev/null 2>&1 &");
    }

    // ------------------------------
    //
    // INI BAGIAN EMAIL UNTUK TIPSTER
    //
    // --
    public function sendMailForgetPassword($email, $NAMA, $url){
        $receivers = [TIPSMailChimp::create_email_receiver($email, $NAMA)];
        return TIPSMailChimp::send_chimp(
            "TIPS - Forgot Your Password $NAMA?",
            TIPSMailChimp::$TMP_FORGOT_PASSWORD,
            [
                TIPSMailChimp::create_template_data('URL_GANTI_KATA_SANDI', $url),
            ],
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





    // ------------------------------
    //
    // INI BAGIAN EMAIL UNTUK TIPSTER varian 2
    //
    // --
    public function sendMailTipster15MinBC($email, $NAMA, $ANTAR_CODE){
        $receivers = [TIPSMailChimp::create_email_receiver($email, $NAMA)];
        TIPSMailChimp::send_chimp(
            "15 menit waktu tersisa untuk konfirmasi kesediaan mengantar barang dengan kode pendaftaran penerbangan $ANTAR_CODE",
            TIPSMailChimp::$TMP_TIPSTER_5,
            [
                TIPSMailChimp::create_template_data('STR_NAMA', $NAMA),
                TIPSMailChimp::create_template_data('STR_ANTAR_CODE', $ANTAR_CODE),
            ],
            $receivers
        );
        // exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'antar' 'code' '1' 'email' '$email' 'NAMA' '$NAMA' 'ANTAR_CODE' '$ANTAR_CODE' >> /var/www/html/tips/zz/logcurlx.txt > /dev/null 2>&1 &");
    }

    public function sendMailTipsterNoConfirmationCancelled($email, $NAMA, $ANTAR_CODE){
        $receivers = [TIPSMailChimp::create_email_receiver($email, $NAMA)];
        TIPSMailChimp::send_chimp(
            "Waktu telah habis untuk konfirmasi kesediaan mengantar barang dengan kode pendaftaran penerbangan $ANTAR_CODE",
            TIPSMailChimp::$TMP_TIPSTER_6,
            [
                TIPSMailChimp::create_template_data('STR_NAMA', $NAMA),
                TIPSMailChimp::create_template_data('STR_ANTAR_CODE', $ANTAR_CODE),
            ],
            $receivers
        );
        // exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'antar' 'code' '1' 'email' '$email' 'NAMA' '$NAMA' 'ANTAR_CODE' '$ANTAR_CODE' >> /var/www/html/tips/zz/logcurlx.txt > /dev/null 2>&1 &");
    }

    public function sendMailTipster15MinBP($email, $NAMA, $ANTAR_CODE){
        $receivers = [TIPSMailChimp::create_email_receiver($email, $NAMA)];
        TIPSMailChimp::send_chimp(
            "15 menit waktu tersisa untuk pengambilan barang antaran TIPS pada TIPS Counter",
            TIPSMailChimp::$TMP_TIPSTER_7,
            [
                TIPSMailChimp::create_template_data('STR_NAMA', $NAMA),
                TIPSMailChimp::create_template_data('STR_ANTAR_CODE', $ANTAR_CODE),
            ],
            $receivers
        );
        // exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'antar' 'code' '1' 'email' '$email' 'NAMA' '$NAMA' 'ANTAR_CODE' '$ANTAR_CODE' >> /var/www/html/tips/zz/logcurlx.txt > /dev/null 2>&1 &");
    }

    public function sendMailTipsterNoPickupCancelled($email, $NAMA, $ANTAR_CODE){
        $receivers = [TIPSMailChimp::create_email_receiver($email, $NAMA)];
        TIPSMailChimp::send_chimp(
            "Waktu telah habis untuk pengambilan barang antaran TIPS pada TIPS Counter",
            TIPSMailChimp::$TMP_TIPSTER_8,
            [
                TIPSMailChimp::create_template_data('STR_NAMA', $NAMA),
                TIPSMailChimp::create_template_data('STR_ANTAR_CODE', $ANTAR_CODE),
            ],
            $receivers
        );
        // exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'antar' 'code' '1' 'email' '$email' 'NAMA' '$NAMA' 'ANTAR_CODE' '$ANTAR_CODE' >> /var/www/html/tips/zz/logcurlx.txt > /dev/null 2>&1 &");
    }


    public function sendMailShipperRejection($email, $NAMA, $SHIPPING_CODE, $NOMOR_CALL_CENTER, $PLUS_TIGA_HARI){
        $receivers = [TIPSMailChimp::create_email_receiver($email, $NAMA)];
        TIPSMailChimp::send_chimp(
            "Paket kiriman anda tidak dapat kami proses lanjut karena teridentifikasi sebagai kategori DG (Dangerous Goods)",
            TIPSMailChimp::$TMP_TIPSTER_9,
            [
                TIPSMailChimp::create_template_data('STR_NAMA', $NAMA),
                TIPSMailChimp::create_template_data('STR_SHIPPING_CODE', $SHIPPING_CODE),
                TIPSMailChimp::create_template_data('STR_NOMOR_CALL_CENTER', $NOMOR_CALL_CENTER),
                TIPSMailChimp::create_template_data('DTE_PLUS_TIGA_HARI', $PLUS_TIGA_HARI),
            ],
            $receivers
        );
        // exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'kirim' 'code' '8' 'email' '$email' 'NAMA' '$NAMA' 'SHIPPING_CODE' '$SHIPPING_CODE' 'RECIPIENT_NAME' '$RECIPIENT_NAME' >> /var/www/html/tips/zz/logcurlx.txt > /dev/null 2>&1 &");
    }
    // ------------------------------
    // ##############################



    // Send e-receipt mail for pickup-ed goods
    // ----
    public function sendMailEReceipt($email, $NAMA, $SHIPPING_CODE, $STR_NAMA_PENGIRIM, $STR_NO_TELP_PENGIRIM, 
                                     $STR_ALAMAT_PENGIRIM, $STR_NAMA_PENERIMA, $STR_NO_TELP_PENERIMA, $STR_ALAMAT_PENERIMA, 
                                     $STR_JUMLAH_HARGA, $STR_ASURANSI, $STR_TOTAL_HARGA){
        $receivers = [TIPSMailChimp::create_email_receiver($email, $NAMA)];
        TIPSMailChimp::send_chimp(
            "TIPS: e-Receipt $SHIPPING_CODE",
            TIPSMailChimp::$TMP_RECEIPT,
            [
                TIPSMailChimp::create_template_data('STR_NAMA', $NAMA),

                TIPSMailChimp::create_template_data('STR_NAMA_PENGIRIM', $STR_NAMA_PENGIRIM),
                TIPSMailChimp::create_template_data('STR_NO_TELP_PENGIRIM', $STR_NO_TELP_PENGIRIM),
                TIPSMailChimp::create_template_data('STR_ALAMAT_PENGIRIM', $STR_ALAMAT_PENGIRIM),

                TIPSMailChimp::create_template_data('STR_NAMA_PENERIMA', $STR_NAMA_PENERIMA),
                TIPSMailChimp::create_template_data('STR_NO_TELP_PENERIMA', $STR_NO_TELP_PENERIMA),
                TIPSMailChimp::create_template_data('STR_ALAMAT_PENERIMA', $STR_ALAMAT_PENERIMA),

                TIPSMailChimp::create_template_data('STR_JUMLAH_HARGA', $STR_JUMLAH_HARGA),
                TIPSMailChimp::create_template_data('STR_ASURANSI', $STR_ASURANSI),
                TIPSMailChimp::create_template_data('STR_TOTAL_HARGA', $STR_TOTAL_HARGA),
            ],
            $receivers
        );
        // exec("sh send_post.sh 'http://127.0.0.1/api/send_email' 'type' 'kirim' 'code' '8' 'email' '$email' 'NAMA' '$NAMA' 'SHIPPING_CODE' '$SHIPPING_CODE' 'RECIPIENT_NAME' '$RECIPIENT_NAME' >> /var/www/html/tips/zz/logcurlx.txt > /dev/null 2>&1 &");
    }
}
