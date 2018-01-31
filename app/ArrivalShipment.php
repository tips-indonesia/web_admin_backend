<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArrivalShipment extends Model
{
    //

    public function arrivalShipmentDetail(){
        return $this->hasMany('App\ArrivalShipmentDetail');
    }
}
