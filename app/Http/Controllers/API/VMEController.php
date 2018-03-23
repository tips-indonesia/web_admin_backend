<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\VMemberEmployee;
use App\User;
use App\MemberList;

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

    public function getUser(Request $request){
        $user = User::where('username', $request->mobile_phone_no)->first();
        if($user == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Nomor handphone tidak ditemukan'
                ],
                'result' => null
            );
        } else {
            if(!Hash::check($request->password, $user->password)) {
                $data = array(
                    'err' => [
                        'code' => 0,
                        'message' => 'Password salah'
                    ],
                    'result' => null
                );
            } else {
            	$member_list = new MemberList;
	            $member_list->mobile_phone_no = $user->username;
	            $member_list->first_name = $user->first_name;
	            $member_list->last_name = $user->last_name;
            	$member_list->email = "";
            	$member_list->registered_date = "";
            	$member_list->profil_picture = "";
            	$member_list->birth_date = "";
            	$member_list->address = "";
            	$member_list->status = "";
            	$member_list->id_city = "";
            	$member_list->token = "";
            	$member_list->sex = "";
            	$member_list->money = "";
                $data = array(
                    'err' => null,
                    'result' => $member_list
                );
            }
        }

        return response()->json($data, 200);
    }

    public function login(Request $request){
    	$user = VMemberEmployee::where('mobile_phone_no', $request->mobile_phone_no)->first();
    	if(!$user){
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Nomor handphone tidak ditemukan'
                ],
                'result' => null
            );
            return response()->json($data, 200);
    	}else{
	    	if($user->is_employee == 'Y')
	    		return $this->getUser($request);
	    	else
	    		return (new UserController())->login($request);
	    }
    }
}
