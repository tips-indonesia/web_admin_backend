<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityList extends Model
{
    public function airportcity(){
        return $this->hasOne('App\AirportcityList', 'id', 'id_airportcity');
    }
}
