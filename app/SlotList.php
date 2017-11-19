<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlotList extends Model
{
    //
    public function shipments(){
        return $this->hasMany('App\Shipment', 'id_slot', 'id');
    }

    public function airportOrigin(){
    	return $this->hasOne('App\AirportList', 'id_origin_airport', 'id');
    }

    public function airportDestination(){
    	return $this->hasOne('App\AirportList', 'id_destination_airport', 'id');
    }
}
