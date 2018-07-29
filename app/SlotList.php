<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\WalletAll;
use App\Http\Controllers\SMSSender;

class SlotList extends Model
{
    //
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function shipments(){
        return $this->hasMany('App\Shipment', 'id_slot', 'id');
    }

    public function airportOrigin(){
        return $this->hasOne('App\AirportList', 'id', 'id_origin_airport');
    }

    public function airline_data(){
        return $this->hasOne('App\AirlinesList', 'id', 'id_airline');
    }

    public function member(){
        return $this->hasOne('App\MemberList', 'id', 'id_member');
    }

    public function packagingList(){
        return $this->hasOne('App\PackagingList','id_slot');
    }

    public function airportDestination(){
        return $this->hasOne('App\AirportList', 'id', 'id_destination_airport');
    }

    function get_detail_status() {
        $step = $this->id_slot_status;
        switch ($step) {
            case 1:
                return "";
            
            case 2:
                return "Klik untuk KONFIRMASI / PEMBATALAN";
            
            case 3:
                return "Temui petugas TIPS di " . $this->airportDestination->initial_code .
                       "\n" . $this->depature;
            
            case 4:
                return "Konter " . $this->airline_data->name .
                       "\n" . $this->depature;
            
            case 5:
                return "Pada petugas TIPS di " . $this->airportDestination->initial_code;
            
            case 6:
                return "";
            
            case 7:
                return "";
            
            default:
                return "";
        }
    }

    public function create_transaction(){
        $price = $this->sold_baggage_space * $this->slot_price_kg;
        $wt = WalletAll::ANTAR_TRANSACTION($this->id_member, $price, 0, "");
    }

    public function create_transaction_bayar_cash(){
        $price = $this->sold_baggage_space * $this->slot_price_kg;
        $wt = WalletAll::CASH_TRANSACTION($this->id_member, 0, $price, "");
    }

    public function smsStep2(){
        if(!$this->id_member)
            return "[EX1] XX";

        $ms_user        = MemberList::find($this->id_member);
        if(!$ms_user)
            return "[EX1] XXY";
        
        $NOHP           = $ms_user->mobile_phone_no;
        $ANTAR_CODE     = $this->slot_id;
        SMSSender::T_send_2($NOHP, $ANTAR_CODE);
    }

    public function smsStep3(){
        if(!$this->id_member)
            return "[EX1] XX";

        $ms_user        = MemberList::find($this->id_member);
        if(!$ms_user)
            return "[EX1] XXY";
        
        $NOHP                   = $ms_user->mobile_phone_no;
        $ORIGIN_AIRPORT_NAME    = $this->airportOrigin->name;
        $_3HOURS_DEPARTURE_TIME = date('Y-m-d H:i:s', strtotime($this->depature) - (60 * 60 * 4));
        SMSSender::T_send_3($NOHP, $ORIGIN_AIRPORT_NAME, $_3HOURS_DEPARTURE_TIME);
    }

    public function smsStep7(){
        if(!$this->id_member)
            return "[EX1] XX";

        $ms_user        = MemberList::find($this->id_member);
        if(!$ms_user)
            return "[EX1] XXY";
        
        $NOHP           = $ms_user->mobile_phone_no;
        SMSSender::T_send_7($NOHP);
    }

}
