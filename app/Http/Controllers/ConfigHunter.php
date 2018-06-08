<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfigZ;

class ConfigHunter extends Controller
{
	public static $CRON_MINUTES_ROUTINE = "CRON_MINUTES_ROUTINE";
    public static $CRON_ITERATOR_ROUTINE = "CRON_ITERATOR_ROUTINE";
    public static $ETC_MESSAGE = "ETC_MESSAGE";
	public function test(){
		ConfigHunter::set("a", "2");
		ConfigHunter::set("a", "5");

		return ConfigHunter::isExist("a")->value;
	}
    public static function isExist($key){
    	$value = ConfigZ::where('key', $key)->first();
    	if($value){
    		return $value;
    	}else{
    		return false;
    	}
    }
    public static function set($key, $value){
    	if($data = ConfigHunter::isExist($key)){
    		$data->value = $value;
    		$data->save();
    		return $data;
    	}else{
    		return ConfigZ::create(array(
    			"key" => $key,
    			"value" => $value
    		));
    	}
    }
}
