<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarBarangGold extends Model
{
    public function barang(){
        return $this->hasOne('App\Shipment', 'id', 'id_barang');
    }
}
