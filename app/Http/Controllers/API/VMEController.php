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

    public function throwException(){
        $data = array(
	        'err' => [
	            'code' => 0,
	            'message' => 'under maintenance'
	        ],
	        'result' => null
	    );

	    return response()->json($data, 200);
    }

    public function login(Request $request){
    	$user = VMemberEmployee::where('mobile_phone_no', $request->mobile_phone_no)->first();
    	if($user->is_employee == 'Y')
    		return $this->throwException();
    	else
    		return UserController()->login($request);
    }
}
