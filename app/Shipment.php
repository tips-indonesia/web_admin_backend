<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    //
    public function cityOrigin(){
    	return $this->hasOne('App\CityList', 'id_origin_city', 'id');
    }

    public function cityDestination(){
    	return $this->hasOne('App\CityList', 'id_destination_city', 'id');
    }
}
