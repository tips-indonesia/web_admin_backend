<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\API\PromotionController;
use App\Http\Controllers\WalletAll;

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
}
