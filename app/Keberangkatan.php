<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keberangkatan extends Model
{
    public function barang2(){
        return $this->hasMany('App\Barang', 'id_keberangkatan', 'id');
    }
}
