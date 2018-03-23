<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VMemberEmployee extends Model
{
    protected $table = 'v_member_employee';

    public function isMember(){
    	return $this->is_employee == 'N'
    }

    public function isEmployee(){
    	return $this->is_employee == 'Y'
    }

    public function user_data(){
    	if($this->isMember())
        	return $this->belongsTo('App\MemberList', 'id');
        else
        	return $this->belongsTo('App\User', 'id');
    }
}
