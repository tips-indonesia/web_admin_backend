<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $guarded = array();
    public function member(){
        return $this->hasOne('App\MemberList', 'id', 'id_member');
    }
}
