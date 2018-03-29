<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirportcityList extends Model
{
    public function airports(){
		return $this->belongsToMany('App\AirportList', 'city_list_airport_list', 'city_id', 'airport_id');
    }
}
