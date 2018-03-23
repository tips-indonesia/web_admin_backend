<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VMemberEmployee extends Model
{
    protected $table = 'v_member_employee';

    public function user_data(){
    	if($this->is_employee == 'N')
        	return $this->belongsTo('App\MemberList', 'id');
        else
        	return $this->belongsTo('App\User', 'id');
    }
}
