<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArrivalShipment extends Model
{
    protected $table = 'delivery_to_arrival_processing_center';

    public function arrivalShipmentDetail(){
        return $this->hasMany('App\ArrivalShipmentDetail');
    }
}
