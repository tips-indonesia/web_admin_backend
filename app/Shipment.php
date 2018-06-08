<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\WalletAll;
use App\Http\Controllers\SMSSender;

class Shipment extends Model
{
    //
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function cityOrigin(){
    	return $this->hasOne('App\AirportcityList', 'id', 'id_origin_city');
    }

    public function cityDestination(){
    	return $this->hasOne('App\AirportcityList', 'id', 'id_destination_city');
    }

    public function slotList(){
    	return $this->hasOne('App\SlotList', 'id', 'id_slot');
    }

    public function create_transaction_estimation(){
        $wt = WalletAll::KIRIM_PAYMENT_TRANSACTION($this->id_shipper, 0, $this->flight_cost + $this->add_insurance_cost, "");
    }

    public function create_transaction(){
        $wt = WalletAll::KIRIM_TRANSACTION($this->id_shipper, 0, $this->flight_cost + $this->add_insurance_cost, "");
    }

    public function smsStep1(){
        if(!$this->id_shipper)
            return;

        $ms_user        = MemberList::find($this->id_shipper);
        if(!$ms_user)
            return;

        $NOHP           = $ms_user->mobile_phone_no;
        $SHIPPING_CODE  = $this->shipment_id;
        SMSSender::S_send_1($NOHP, $SHIPPING_CODE);
    }

    public function smsStep1Setengah(){
        if(!$this->id_shipper)
            return;

        $ms_user        = MemberList::find($this->id_shipper);
        if(!$ms_user)
            return;
        
        $NOHP           = $ms_user->mobile_phone_no;
        SMSSender::S_send_1_setengah($NOHP);
    }

    public function smsStep2(){
        if(!$this->id_shipper)
            return;

        $ms_user        = MemberList::find($this->id_shipper);
        if(!$ms_user)
            return;
        
        $NOHP           = $ms_user->mobile_phone_no;
        SMSSender::S_send_2($NOHP);
    }

    public function smsStep8(){
        if(!$this->id_shipper)
            return;

        $ms_user        = MemberList::find($this->id_shipper);
        if(!$ms_user)
            return;
        
        $NOHP           = $ms_user->mobile_phone_no;
        $SHIPPING_CODE  = $this->shipment_id;
        $RECIPIENT_NAME = $this->received_by;
        SMSSender::S_send_8($NOHP, $SHIPPING_CODE, $RECIPIENT_NAME);
    }
}
