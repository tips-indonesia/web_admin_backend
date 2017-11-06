<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilityController extends Controller
{
	private $json = '[{"tripId":1,"weigth":15,"ts":422},{"tripId":2,"weigth":1,"ts":784},{"tripId":3,"weigth":19,"ts":849},{"tripId":4,"weigth":14,"ts":730},{"tripId":5,"weigth":17,"ts":401},{"tripId":6,"weigth":2,"ts":725},{"tripId":7,"weigth":9,"ts":462},{"tripId":8,"weigth":4,"ts":630},{"tripId":9,"weigth":5,"ts":760},{"tripId":10,"weigth":3,"ts":142},{"tripId":11,"weigth":11,"ts":901},{"tripId":12,"weigth":16,"ts":662},{"tripId":13,"weigth":8,"ts":955},{"tripId":14,"weigth":20,"ts":575},{"tripId":15,"weigth":18,"ts":749},{"tripId":16,"weigth":7,"ts":503},{"tripId":17,"weigth":13,"ts":985},{"tripId":18,"weigth":6,"ts":367},{"tripId":19,"weigth":10,"ts":687},{"tripId":20,"weigth":12,"ts":306}]';

	private $json2 = '[{"tId":101,"space":14,"av":14,"data":{}},{"tId":102,"space":8,"av":8,"data":{}},{"tId":103,"space":4,"av":4,"data":{}},{"tId":104,"space":11,"av":11,"data":{}},{"tId":105,"space":1,"av":1,"data":{}},{"tId":106,"space":16,"av":16,"data":{}}]';

	private $packageDB;

    public function test(){
		$input = json_decode($this->json);
		$this->packageDB = json_decode($this->json2);
		for($i = 0; $i < sizeof($this->packageDB); $i++)
			$this->packageDB[$i]->data = array();

		for($i = 0; $i < sizeof($input); $i++)
	    	$this->pack($input[$i]);
    }

    private function reSortPDB(){
    	usort($this->packageDB, function ($a, $b) {
			$a = $a->av;
		    $b = $b->av;

		    if ($a == $b) return 0;
		    return ($a < $b) ? -1 : 1;
        });
    }

    private function pack($inx){
    	$this->reSortPDB();

    	echo "--> IN tips #" . $inx->tripId . ", weight = " . $inx->weigth . "<br/><br/>";

    	echo "Avaiable bags: <br/>";
		for($i = 0; $i < sizeof($this->packageDB); $i++)
			echo "bag[" . $this->packageDB[$i]->tId . "], capacity = " . $this->packageDB[$i]->av . "<br/>";

    	echo "<br/>";

    	$idx = -1;
    	for($i = 0; $i < sizeof($this->packageDB); $i++){
    		if($this->packageDB[$i]->av >= $inx->weigth){
    			$idx = $i;
    			break;
    		}
    	}

    	if($idx == -1){
    		echo "XXX Cannot package tips #" . $inx->tripId . ", weigth = " . $inx->weigth . " anymore" . "<br/><br/>";
    	echo "-----------------------------------------------------------------";
    	echo "<br/>";
    	echo "<br/>";
    		return -1;
    	}

    	echo "--> OUT Pack tips #" . $inx->tripId . ", weight = " . $inx->weigth . " to bag[" . $this->packageDB[$idx]->tId . "]<br/>";
		array_push($this->packageDB[$idx]->data, $inx);
		$this->packageDB[$idx - 0]->av -= $inx->weigth;
		// print_r($this->packageDB[$idx]);
    	echo "<br/>";
    	echo "-----------------------------------------------------------------";
    	echo "<br/>";
    	echo "<br/>";
    }

}
