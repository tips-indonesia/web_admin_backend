<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArrivalShipmentDetail extends Model
{    
    public function packagingList(){
        return $this->belongsTo('App\PackagingList','packaging_lists_id','id');
    }
}
