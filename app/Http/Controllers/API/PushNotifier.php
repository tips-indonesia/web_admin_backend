<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMSender;
use App\SlotList;
use App\MemberList;
use App\Http\Controllers\SMSSender;
use App\Http\Controllers\cURLFaker;
use App\Http\Controllers\ConfigHunter;
use App\DualLanguage;
use App\NotificationText;

class PushNotifier extends Controller
{

    private $bsc;

    public function __construct(){
        $this->bsc = new cURLFaker;
    }
    
    //
	public function delivery_push_notifier($message, $user, $slot){
        FCMSender::post([ "type" 	=> 'Delivery', 
        				  "id" 		=> $slot->slot_id, 
        				  "status" 	=> "0",
        				  "message" => $message, 
        				  "detail" 	=> "" ], $user->token);
        return \Carbon\Carbon::now()->toDateTimeString();
	}

	public function delivery_sms_sender($message, $user){
        SMSSender::kirim($user->mobile_phone_no, rawurlencode($message));
	}

    //
    public function shipment_push_notifier($message, $user, $shipment){
        FCMSender::post([ "type"    => 'Shipment', 
                          "id"      => $shipment->shipment_id, 
                          "status"  => "0",
                          "message" => $message, 
                          "detail"  => "" ], $user->token);
        return \Carbon\Carbon::now()->toDateTimeString();
    }

    public function shipment_sms_sender($message, $user){
        SMSSender::kirim($user->mobile_phone_no, rawurlencode($message));
    }

    public function _15mins_before_confirmation_cutoff($user, $slot){
        $lang = DualLanguage::getActiveLang($user->id);
        $push_message = NotificationText::getByKey('microservice_confirmation_reminder', $lang, NotificationText::PUSH_COLUMN);
        //"Sisa waktu Anda 15 menit untuk konfirmasi kesediaan mengantar barang";
    	$this->delivery_push_notifier($push_message, $user, $slot);

    	$antar_code = $slot->slot_id;
        $sms_message = NotificationText::getByKeyWithChange('microservice_confirmation_reminder', $lang, [$antar_code], NotificationText::SMS_COLUMN);
        //"Sisa waktu Anda tinggal 15 menit lagi untuk konfirmasi kesediaan mengantar barang pada aplikasi TIPS dengan kode pendaftaran penerbangan $antar_code milik Anda";
    	$this->delivery_sms_sender($sms_message, $user);
        $this->bsc->sendMailTipster15MinBC($user->email, $user->first_name . " " . $user->last_name, $antar_code);
    }

    public function _4hours_before_departure_confirmation_timeout($user, $slot){
        $lang = DualLanguage::getActiveLang($user->id);
        $push_message = NotificationText::getByKey('microservice_confirmation_cancellation', $lang, NotificationText::PUSH_COLUMN);
        //"Sisa waktu telah habis untuk konfirmasi kesediaan mengantar barang, pendaftaran penerbangan Anda telah dibatalkan";
    	$this->delivery_push_notifier($push_message, $user, $slot);

    	$antar_code = $slot->slot_id;
        $sms_message = NotificationText::getByKeyWithChange('microservice_confirmation_cancellation', $lang, [$antar_code], NotificationText::SMS_COLUMN);
        //"Sisa waktu konfirmasi kesediaan mengantar pada aplikasi TIPS sudah habis, pendaftaran penerbangan $antar_code milik Anda telah dibatalkan.";
    	$this->delivery_sms_sender($sms_message, $user);
        $this->bsc->sendMailTipsterNoConfirmationCancelled($user->email, $user->first_name . " " . $user->last_name, $antar_code);
    }

    public function _15mins_before_pickup_cutoff($user, $slot){
        $lang = DualLanguage::getActiveLang($user->id);
        $push_message = NotificationText::getByKey('microservice_pickup_reminder', $lang, NotificationText::PUSH_COLUMN);
        //"Sisa waktu Anda 15 menit untuk mengambil barang antaran TIPS pada TIPS Counter";
    	$this->delivery_push_notifier($push_message, $user, $slot);

    	$antar_code = $slot->slot_id;
        $sms_message = NotificationText::getByKeyWithChange('microservice_pickup_reminder', $lang, [$antar_code], NotificationText::SMS_COLUMN);
        //"Sisa waktu Anda untuk pengambilan barang antaran TIPS dengan kode pendaftaran penerbangan $antar_code pada TIPS Counter tinggal 15 menit. Bila barang antaran tidak diambil sesuai batas waktu tersebut maka kesediaan Anda menjadi TIPSTER otomatis dianggap batal.";
    	$this->delivery_sms_sender($sms_message, $user);
        $this->bsc->sendMailTipster15MinBP($user->email, $user->first_name . " " . $user->last_name, $antar_code);
    }

    public function _2hours_before_departure_pickup_timeout($user, $slot){
        $lang = DualLanguage::getActiveLang($user->id);
        $push_message = NotificationText::getByKey('microservice_pickup_cancellation', $lang, NotificationText::PUSH_COLUMN);
        //"Sisa waktu Anda telah habis untuk pengambilan barang antaran TIPS pada TIPS Counter, kesediaan Anda menjadi TIPSTER otomatis telah dibatalkan";
    	$this->delivery_push_notifier($push_message, $user, $slot);

    	$antar_code = $slot->slot_id;
        $sms_message = NotificationText::getByKeyWithChange('microservice_pickup_cancellation', $lang, [$antar_code], NotificationText::SMS_COLUMN);
        //"Sisa waktu Anda telah habis untuk pengambilan barang antaran TIPS dengan kode pendaftaran penerbangan $antar_code pada TIPS Counter, kesediaan Anda menjadi TIPSTER otomatis telah dibatalkan karena tidak melakukan pengambilan.";
    	$this->delivery_sms_sender($sms_message, $user);
        $this->bsc->sendMailTipsterNoPickupCancelled($user->email, $user->first_name . " " . $user->last_name, $antar_code);
    }

    public function _rejection_or_return_to_sender_dg($user, $shipment){
        $lang = DualLanguage::getActiveLang($user->id);
        $kirim_code = $shipment->shipment_id;
        $push_message = NotificationText::getByKeyWithChange('shipment_dangerous_goods_cancel_rejection', $lang, [$kirim_code], NotificationText::PUSH_COLUMN);
        //"Paket kiriman anda dengan kode pengiriman $kirim_code tidak dapat kami proses lanjut karena teridentifikasi sebagai kategori DG (Dangerous Goods)";
        $this->shipment_push_notifier($push_message, $user, $shipment);

        $ncc = ConfigHunter::getCCNumber();
        $sms_message = NotificationText::getByKeyWithChange('shipment_dangerous_goods_cancel_rejection', $lang, [$ncc], NotificationText::SMS_COLUMN);
        //"Paket kiriman anda tidak dapat kami proses lanjut karena teridentifikasi sebagai kategori DG (Dangerous Goods). Untuk info lebih lanjut mohon cek email inbox Anda atau hubungi tim kami di nomor $ncc";
        $this->shipment_sms_sender($sms_message, $user);

        date_default_timezone_set('Asia/Jakarta');
        $_3nextdays = date('d/m/Y', strtotime(date(now())) + 60 * 60 * 24 * 3);
        $this->bsc->sendMailShipperRejection($user->email, $user->first_name . " " . $user->last_name, $kirim_code, $ncc, $_3nextdays);
    }

    public function _no_shipment_for_tipster($user, $slot){
        $lang = DualLanguage::getActiveLang($user->id);
        $antar_code = $slot->slot_id;
        $push_message = NotificationText::getByKeyWithChange('microservice_no_matched_shipment', $lang, [$antar_code], NotificationText::PUSH_COLUMN);
        //"Maaf, kode pendaftaran penerbangan $antar_code Anda otomatis telah dibatalkan karena belum tersedia barang antaran";
        $this->delivery_push_notifier($push_message, $user, $slot);

        $sms_message = NotificationText::getByKeyWithChange('microservice_no_matched_shipment', $lang, [$antar_code], NotificationText::SMS_COLUMN);
        //"Maaf, kode pendaftaran penerbangan $antar_code Anda otomatis telah dibatalkan karena belum tersedia barang antaran sampai dengan batas waktu maksimal pengambilan barang antaran di TIPS Counter untuk penerbangan Anda.";
        $this->delivery_sms_sender($sms_message, $user);
        $this->bsc->sendMailNoShipmentForTipster($user->email, $user->first_name . " " . $user->last_name, $antar_code);
    }

    private function responseOK(){
    	return [
            'err' => null,
            'result' => [
            	'status' => true
            ]
        ];
    }

    private function responseNotOK(){
    	return [
            'err' => [
                "code" => 500,
                "message" => "something went wrong"
            ],
            'result' => null
        ];
    }

    public function _1($slot_id){

    	// find slot, if fails terminate
    	$slot = SlotList::where('slot_id', $slot_id)->first();
    	if(!$slot){
    		return response()->json($this->responseNotOK(), 200);
    	}

    	// find user, if fails terminate
    	$user = MemberList::find($slot->id_member);
    	if(!$user){
    		return response()->json($this->responseNotOK(), 200);
    	}
    	
    	// send push notification if and only if slot status = 2
    	if($slot->id_slot_status == 2){
    		$this->_15mins_before_confirmation_cutoff($user, $slot);
    	}

    	return response()->json($this->responseOK(), 200);
    }

    public function _2($slot_id){

    	// find slot, if fails terminate
    	$slot = SlotList::where('slot_id', $slot_id)->first();
    	if(!$slot){
    		return response()->json($this->responseNotOK(), 200);
    	}

    	// find user, if fails terminate
    	$user = MemberList::find($slot->id_member);
    	if(!$user){
    		return response()->json($this->responseNotOK(), 200);
    	}

    	// send push notification if and only if slot status = 3
    	if($slot->id_slot_status == 3){
    		$this->_15mins_before_pickup_cutoff($user, $slot);
    	}

    	return response()->json($this->responseOK(), 200);
    }
}
