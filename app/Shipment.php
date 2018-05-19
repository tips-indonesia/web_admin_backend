<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\WalletAll;

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

    public function create_transaction(){
        if($this->id_wallet_transaction != null){
            WalletAll::KIRIM_TRANSACTION($this->id_shipper, 0, 0, 
                "Fail while creating transaction, shipment " . $this->shipment_id);
            return;
        }


        $wt = WalletAll::KIRIM_TRANSACTION($this->id_shipper, $this->flight_cost, 0, "");
        $this->id_wallet_transaction = $wt->id;
        $this->save();
    }
}
