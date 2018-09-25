<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMSender;
use App\SlotList;
use App\MemberList;
use App\Http\Controllers\SMSSender;

class PushNotifier extends Controller
{
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
        SMSSender::kirim($user->mobile_phone_no, $message);
	}

    public function _15mins_before_confirmation_cutoff($user, $slot){
    	$push_message = "Sisa waktu Anda 15 menit untuk konfirmasi kesediaan mengantar barang";
    	$this->delivery_push_notifier($push_message, $user, $slot);

    	$antar_code = $slot->slot_id;
    	$sms_message = "Sisa waktu Anda tinggal 15 menit lagi untuk konfirmasi kesediaan mengantar barang pada aplikasi TIPS dengan kode pendaftaran penerbangan $antar_code milik Anda"
    	$this->delivery_sms_sender($sms_message, $user);
    }

    public function _4hours_before_departure_confirmation_timeout($user, $slot){
    	$push_message = "Sisa waktu telah habis untuk konfirmasi kesediaan mengantar barang, pendaftaran penerbangan Anda telah dibatalkan";
    	$this->delivery_push_notifier($push_message, $user, $slot);

    	$antar_code = $slot->slot_id;
    	$sms_message = "Sisa waktu konfirmasi kesediaan mengantar pada aplikasi TIPS sudah habis, pendaftaran penerbangan $antar_code milik Anda telah dibatalkan."
    	$this->delivery_sms_sender($sms_message, $user);
    }

    public function _15mins_before_pickup_cutoff($user, $slot){
    	$push_message = "Sisa waktu Anda 15 menit untuk mengambil barang antaran TIPS pada TIPS Counter";
    	$this->delivery_push_notifier($push_message, $user, $slot);

    	$antar_code = $slot->slot_id;
    	$sms_message = "Sisa waktu Anda untuk pengambilan barang antaran TIPS dengan kode pendaftaran penerbangan $antar_code pada TIPS Counter tinggal 15 menit. Bila barang antaran tidak diambil sesuai batas waktu tersebut maka kesediaan Anda menjadi TIPSTER otomatis dianggap batal."
    	$this->delivery_sms_sender($sms_message, $user);
    }

    public function _2hours_before_departure_pickup_timeout($user, $slot){
    	$push_message = "Sisa waktu Anda telah habis untuk pengambilan barang antaran TIPS pada TIPS Counter, kesediaan Anda menjadi TIPSTER otomatis telah dibatalkan";
    	$this->delivery_push_notifier($push_message, $user, $slot);

    	$antar_code = $slot->slot_id;
    	$sms_message = "Sisa waktu Anda telah habis untuk pengambilan barang antaran TIPS dengan kode pendaftaran penerbangan $antar_code pada TIPS Counter, kesediaan Anda menjadi TIPSTER otomatis telah dibatalkan karena tidak melakukan pengambilan."
    	$this->delivery_sms_sender($sms_message, $user);
    }

    public function _1($slot_id){

    	// find slot, if fails terminate
    	$slot = SlotList::where('slot_id', $slot_id)->first();
    	if(!$slot){
    		return;
    	}

    	// find user, if fails terminate
    	$user = MemberList::find($slot->id_member);
    	if(!$user){
    		return;
    	}
    	
    	// send push notification if and only if slot status = 2
    	if($slot->id_slot_status == 2){
    		$this->_15mins_before_confirmation_cutoff($user, $slot);
    	}
    }

    public function _2($slot_id){

    	// find slot, if fails terminate
    	$slot = SlotList::where('slot_id', $slot_id)->first();
    	if(!$slot){
    		return;
    	}

    	// find user, if fails terminate
    	$user = MemberList::find($slot->id_member);
    	if(!$user){
    		return;
    	}

    	// send push notification if and only if slot status = 3
    	if($slot->id_slot_status == 3){
    		$this->_15mins_before_pickup_cutoff($user, $slot);
    	}
    }
}
