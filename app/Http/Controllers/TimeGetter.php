<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class TimeGetter extends Controller
{
    //
    public function secondsToNow($offsetSeconds, $datetimestring){
    	// set timezone to local Jakarta
        date_default_timezone_set('Asia/Jakarta'); 

        // current date
        $date = new DateTime('NOW');

        // relative date
        $date2 = new DateTime(date('Y-m-d H:i:s', strtotime($datetimestring) + $offsetSeconds));

        // return the difference
        return $date2->getTimestamp() - $date->getTimestamp();
    }
}
