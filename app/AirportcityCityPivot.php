<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirportcityCityPivot extends Model
{
    public function airportCity(){
        return $this->belongsTo('App\AirportcityList', 'id_airportcity', 'id');
    }
    public function city(){
        return $this->belongsTo('App\City', 'id_city', 'id');
    }
}
