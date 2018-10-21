<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\API\PromotionController;
use App\Http\Controllers\WalletAll;
use DateTime;

class MemberList extends Model
{
    public function create_transaction_ref(){
    	if(!$this->register_by)
    		return;

        $datarc = explode(':', $this->register_by);
        if($datarc[0] != 'REF')
            return;

        $ref_code = $datarc[1];

    	$referal_data = PromotionController::getSingleReferral();
    	if(!$referal_data)
    		return;

        $wt = WalletAll::REFFERED_TRANSACTION($this->id, $referal_data->referred_amount, 
			  0, "REF: " . $ref_code);

        $member_referred = MemberList::where('ref_code', $ref_code)->first();
        if(!$member_referred)
        	return;

        $wt_referred = WalletAll::REFFERAL_TRANSACTION($member_referred->id, $referal_data->referral_amount, 
        			   0, "REF: " . $ref_code);
    }

    public function office(){
        if(!$this->id_office)
            return false;

        return OfficeList::find($this->id_office);
    }

    public function isOfficeRight($id_city){
        $office = $this->office();
        if(!$office)
            return false;

        return $office->id_area == $id_city;
    }

    private function gen_uuid() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

    public function createStoreToken(){
        date_default_timezone_set('Asia/Jakarta');
        $expiry_time = strtotime('now + 10 minutes');
        $this->store_token = $this->gen_uuid();
        $this->store_token_expiry = $expiry_time;
        $this->save();
    }

    public function filter_data($instance, $filters){
        $out = [];
        $nout = [];
        
        foreach ($filters as $f){
            if(!is_null($instance[$f]))
                $out[$f] = $instance[$f];
            else
                array_push($nout, $f);
        }

        return [
            "found" => $out,
            "not_found" => $nout
        ];
    }
}
