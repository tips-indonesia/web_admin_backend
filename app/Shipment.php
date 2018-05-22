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
        $wt = WalletAll::KIRIM_TRANSACTION($this->id_shipper, 0, $this->flight_cost + $this->add_insurance_cost, "");
    }
}
