<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackagingList extends Model
{
    //
    public function slotList(){
    	return $this->hasOne('App\SlotList', 'id', 'id_slot');
    }
}
