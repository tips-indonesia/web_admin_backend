<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CronTimer;

class Delivery extends Model
{
    public function startCountingLife(){
    	$slot_id = $this->slot_id;
        $time_to_execute = 4 * 60 * 60;
        $ct = CronTimer::first();
        if($ct){
            $time_to_execute = $ct->cron_timer;
        }
        exec("sh start_timer.sh $time_to_execute $slot_id >> ~/logcurlx.txt > /dev/null 2>&1 &");
    }
}
