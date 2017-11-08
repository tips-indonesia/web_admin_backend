<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\MemberList;

class UserController extends Controller
{
    //
    function login(Request $request) {
        $member_list = MemberList::where('username', $request->username)->first();
        if($member_list == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Username tidak ditemukan'
                ],
                'result' => null
            );
        } else {
            if(!Hash::check($request->password, $member_list->password)) {
                $data = array(
                    'err' => [
                        'code' => 0,
                        'message' => 'Password salah ditemukan'
                    ],
                    'result' => null
                );


            } else {
                unset($member_list['password']);
                $data = array(
                    'err' => null,
                    'result' => $member_list
                );
            }
        }

        return response()->json($data, 200);
    }

    function register(Request $request) {
        $member_list = MemberList::where('username', $request->username)->first();
        if($member_list != null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Username telah terdaftar'
                ],
                'result' => null
            );
        } else {
            $member_list = new MemberList;
            $member_list->username = $request->username;
            $member_list->password = bcrypt($request->password);
            $member_list->registered_date = date('Y-m-d');
            $member_list->first_name = $request->first_name;
            $member_list->address = $request->address;
            $member_list->email = $request->email;
            $member_list->id_city = $request->id_city;


            if($request->has('last_name')) {
                $member_list->last_name = $request->last_name;
            }

            if($request->has('birth_date')) {
                $member_list->birth_date = date('Y-m-d', strtotime($request->birth_date));
            }

            if($request->has('mobile_phone_no')) {
                $member_list->mobile_phone_no = $request->mobile_phone_no;
            }

            $member_list->save();
            unset($member_list['password']);
            $data = array(
                'err' => null,
                'result' => $member_list
            );

        }

        return response()->json($data, 200);

    }
}
