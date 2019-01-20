<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NotificationText;
class SMSSender extends Controller
{

	public function testSMS(Request $request){
		$request->nohp = "081214338487";
		$request->pesan = "Sukarno - hatta";
		if(!$request->nohp || !$request->pesan)
			return "nohp atau pesan tidak boleh kosong";

		dd(SMSSender::kirim($request->nohp, $request->pesan));
	}

	/**
	  * @param payload data
	  * @param destination -> dapat berupa token spesifik user atau topik
	  */
    public static function kirim($nohp, $pesan){
		$url = "https://alpha.zenziva.net/apps/smsapi.php?userkey=bj82g0&passkey=ng1r1mSMSkeV1incEnT&nohp=$nohp&pesan=$pesan";
        $context  = stream_context_create();
        $result = @file_get_contents($url, false, $context);
		return $result;
	}

	public static function cekBalance(){
		$url = "https://alpha.zenziva.net/apps/getbalance.php?userkey=bj82g0&passkey=ng1r1mSMSkeV1incEnT";
        $context  = stream_context_create();
        $result = @file_get_contents($url, false, $context);
		return $result;
	}


	// TIPSTER
	public static function T_send_2($NOHP, $ANTAR_CODE, $lang = 'id'){
		$msg = NotificationText::getByKeyWithChange('notiftipster02', $lang, [$ANTAR_CODE], NotificationText::SMS_COLUMN);
		//"Barang antaran TIPS sudah tersedia untuk kode pendaftaran penerbangan $ANTAR_CODE milik Anda. Segera konfirmasi kesediaan mengantar di aplikasi TIPS.";
		return SMSSender::kirim($NOHP, rawurlencode($msg));
	}

	public static function T_send_3($NOHP, $ORIGIN_AIRPORT_NAME, $_3HOURS_DEPARTURE_TIME, $lang = 'id'){
		// $msg = "Pastikan Anda tiba di bandara $ORIGIN_AIRPORT_NAME pada pukul $_3HOURS_DEPARTURE_TIME untuk mengambil barang antaran TIPS.\n\nReminder 4 hours before departure:\nJangan lupa ambil barang antaran TIPS Anda di bandara $ORIGIN_AIRPORT_NAME.";
		$msg = NotificationText::getByKeyWithChange('notiftipster03', $lang, [$ORIGIN_AIRPORT_NAME, $_3HOURS_DEPARTURE_TIME], NotificationText::SMS_COLUMN);
		//"Pastikan Anda tiba di bandara $ORIGIN_AIRPORT_NAME pada pukul $_3HOURS_DEPARTURE_TIME untuk mengambil barang antaran TIPS.\n";
		return SMSSender::kirim($NOHP, rawurlencode($msg));
	}

	public static function T_send_7($NOHP, $lang = 'id'){
		$msg = NotificationText::getByKey('notiftipster07', $lang, NotificationText::SMS_COLUMN);
		//"Barang antaran telah diverifikasi, proses telah selesai. Terima kasih atas kerja sama Anda.";
		return SMSSender::kirim($NOHP, rawurlencode($msg));
	}


	// SHIPPER
	public static function S_send_1($NOHP, $SHIPPING_CODE, $lang = 'id'){
		$msg = NotificationText::getByKeyWithChange('notifshipper01', $lang, [$SHIPPING_CODE], NotificationText::SMS_COLUMN);
		//"Pengiriman Anda dengan kode $SHIPPING_CODE telah terdaftar. Tim TIPS akan segera menghubungi Anda.";
		return SMSSender::kirim($NOHP, rawurlencode($msg));
	}

	public static function S_send_1_setengah($NOHP, $lang = 'id'){
		$msg = NotificationText::getByKey('notifshipper01_worker', $lang, NotificationText::SMS_COLUMN);
		//"Kami akan segera menjemput paket Anda pada alamat yang tertera di aplikasi. Pastikan barang Anda siap untuk dikirim.";
		return SMSSender::kirim($NOHP, rawurlencode($msg));
	}

	public static function S_send_2($NOHP, $lang = 'id'){
		$msg = NotificationText::getByKey('notifshipper02', $lang, NotificationText::SMS_COLUMN);
		//"Terima kasih atas kepercayaan Anda. Silahkan periksa email Anda untuk melihat Tanda Terima dari TIPS.";
		return SMSSender::kirim($NOHP, rawurlencode($msg));
	}

	public static function S_send_8($NOHP, $SHIPPING_CODE, $RECIPIENT_NAME, $lang = 'id'){
		$msg = NotificationText::getByKeyWithChange('notifshipper08', $lang, [$SHIPPING_CODE, $RECIPIENT_NAME], NotificationText::SMS_COLUMN);
		//"Barang kiriman Anda dengan kode pengiriman $SHIPPING_CODE sudah diambil oleh: $RECIPIENT_NAME";
		return SMSSender::kirim($NOHP, rawurlencode($msg));
	}
}
