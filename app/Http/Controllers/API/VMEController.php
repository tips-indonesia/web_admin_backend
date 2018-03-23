<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\VMemberEmployee;

class VMEController extends Controller
{
    public function getAll(){
        $data = array(
            'err' => null,
            'result' => VMemberEmployee::all()
        );

    	return response()->json($data, 200);
    }
}
