<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArrivalShipmentDetail extends Model
{    
	protected $table = 'delivery_to_arrival_processing_center_detil';

    public function packagingList(){
        return $this->belongsTo('App\PackagingList','packaging_lists_id','id');
    }
}
