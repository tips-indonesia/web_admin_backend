<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
