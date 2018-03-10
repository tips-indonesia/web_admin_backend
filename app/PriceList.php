<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    public function originCity(){
        return $this->belongsTo('App\AirportcityList', 'id_origin_city', 'id');
    }
    public function destinationCity(){
        return $this->belongsTo('App\AirportcityList', 'id_destination_city', 'id');
    }
}
