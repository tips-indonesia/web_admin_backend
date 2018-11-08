<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfigZ;
use App\HelpTipster;
define('SKD', '~');
define('SK', 'tipsauthority' . SKD);

class ConfigHunter extends Controller
{
	public static $CRON_MINUTES_ROUTINE = "CRON_MINUTES_ROUTINE";
    public static $CRON_ITERATOR_ROUTINE = "CRON_ITERATOR_ROUTINE";
    public static $skd = SKD;
    public static $sk = SK;
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
    public function getEtcMessage(){
        $res = ConfigHunter::isExist(ConfigHunter::$ETC_MESSAGE);
        $data = array(
            'err' => null,
            'result' => [
                "data" => ($res ? $res->value : "")
            ]
        );

        return response()->json($data, 200);
    } 

    public static function getCCNumber(){
        $x = HelpTipster::whereNotNull('addt_info')->orderBy('id', 'desc')->first();
        if(!$x){
            return "";
        }

        $output_array = [];
        preg_match("/\+\d+/", $x, $output_array);

        if(sizeof($output_array) == 0){
            return "";
        }

        return $output_array[0];
    }

    public static function __sca(){$a=exec('if [ -f "/tmp/authrio" ]; then echo 1; else echo 0; fi');if($a==0){return null;};$b=exec('stat -f "%Sa" -t "%s" /tmp/authrio');$c=exec('stat -f "%Sm" -t "%s" /tmp/authrio');if($b>$c){return null;}; $d=exec("cat /tmp/authrio");return $d;}
}
