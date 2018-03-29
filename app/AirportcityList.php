<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirportcityList extends Model
{
    public function airports(){
        return $this->hasMany('App\AirportList', 'id_city', 'id');
    }
}
