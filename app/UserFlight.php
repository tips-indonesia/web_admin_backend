<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\WalletAll;
use App\Http\Controllers\SMSSender;
use App\Http\Controllers\cURLFaker;

class UserFlight extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_date','payment_until'];


    public function create_transaction_estimation(){
        $wt = WalletAll::KIRIM_PAYMENT_TRANSACTION($this->id_shipper, 
                0, $this->flight_cost + $this->add_insurance_cost, $this->shipment_id);
    }

    public function update_status($new_status) {
        $this->booking_status = $new_status;
        $this->save();
    }

    public function delete_transaction_estimation(){
        $wt = WalletAll::DELETE_KIRIM_PAYMENT_TRANSACTION($this->id_shipper, $this->shipment_id);
    }

    public function create_transaction(){
        $ut = WalletAll::UPDATE_KIRIM_PAYMENT_TRANSACTION($this->id_shipper, 
                0, $this->flight_cost + $this->add_insurance_cost, $this->shipment_id);

        $wt = WalletAll::KIRIM_TRANSACTION($this->id_shipper, 
                $this->flight_cost + $this->add_insurance_cost, 0, $this->shipment_id);
    }


    function get_detail_status() {
        $step = $this->id_slot_status;
        switch ($step) {
            case 1:
                return "";
            
            case 2:
                return "";
            
            case 3:
                return "";
            
            case 4:
                return "";
            
            case 5:
                return "";
            
            case 6:
                return "";
            
            case 7:
                return "";
            
            case 8:
                return "";
            
            default:
                return "";
        }
    }

    public function send_mail_receipt(){
        $bsc            = new cURLFaker;
        $ms_user        = MemberList::find($this->id_shipper);
        if($ms_user){
            $email                  = $ms_user->email;
            $NAMA                   = $ms_user->first_name . ' ' . $ms_user->last_name;
            $SHIPPING_CODE          = $this->shipment_id;

            $STR_NAMA_PENGIRIM      = $this->shipper_first_name . ' ' . $this->shipper_last_name;
            $STR_NO_TELP_PENGIRIM   = $this->shipper_mobile_phone;
            $STR_ALAMAT_PENGIRIM    = $this->shipper_address;

            $STR_NAMA_PENERIMA      = $this->consignee_first_name . ' ' . $this->consignee_last_name;
            $STR_NO_TELP_PENERIMA   = $this->consignee_mobile_phone;
            $STR_ALAMAT_PENERIMA    = $this->consignee_address;

            $STR_JUMLAH_HARGA       = $this->flight_cost;
            $STR_ASURANSI           = $this->add_insurance_cost;
            $STR_TOTAL_HARGA        = (string) ($this->flight_cost + $this->add_insurance_cost);

            if($email)
                $bsc->sendMailEReceipt($email, $NAMA, $SHIPPING_CODE, $STR_NAMA_PENGIRIM, $STR_NO_TELP_PENGIRIM, 
                        $STR_ALAMAT_PENGIRIM, $STR_NAMA_PENERIMA, $STR_NO_TELP_PENERIMA, $STR_ALAMAT_PENERIMA, 
                        $STR_JUMLAH_HARGA, $STR_ASURANSI, $STR_TOTAL_HARGA);
        }
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
