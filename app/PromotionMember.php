<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionMember extends Model
{
    protected $guarded = array();

    public function member(){
        return $this->belongsTo('App\MemberList', 'id_member', 'id');
    }

    public function promotion(){
        return $this->belongsTo('App\Promotion', 'id_promotion', 'id');
    }
}
