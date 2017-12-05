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
        $member_list = MemberList::where('mobile_phone_no', $request->mobile_phone_no)->first();
        if($member_list == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Nomor handphone tidak ditemukan'
                ],
                'result' => null
            );
        } else {
            if(!Hash::check($request->password, $member_list->password)) {
                $data = array(
                    'err' => [
                        'code' => 0,
                        'message' => 'Password salah'
                    ],
                    'result' => null
                );



            } else {
                if($request->has('token')) {
                    $member_list->token = $request->token;
                }
                $member_list->save();
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
        $member_list = MemberList::where('mobile_phone_no', $request->mobile_phone_no)->first();
        if($member_list != null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Nomor handphone telah terdaftar'
                ],
                'result' => null
            );
        } else {
            $member_list = new MemberList;
            $member_list->mobile_phone_no = $request->mobile_phone_no;
            $member_list->name = $request->name;
            $member_list->email = $request->email;
            $member_list->password = bcrypt($request->password);
            $member_list->registered_date = date('Y-m-d');

            if($request->has('birth_date')) {
                $member_list->birth_date = date('Y-m-d', strtotime($request->birth_date));
            }

            if($request->has('id_city')) {
                $member_list->id_city = $request->id_city;
            }

            if($request->has('address')) {
                $member_list->address = $request->address;
            }

            if($request->has('token')) {
                $member_list->token = $request->token;
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

    function update_profile(Request $request) {
        $member = MemberList::find($request->member_id);

        if($member == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'User Id tidak ditemukan'
                ],
                'result' => null
            );
        } else {
            if($request->has('name')) {
                $member->name = $request->name;
            }

            if($request->has('email')) {
                $member->email = $request->email;
            }

            if($request->has('mobile_phone_no')) {
                $member->mobile_phone_no = $request->mobile_phone_no;
            }

            if($request->has('password')) {
                $member->password = bcrypt($request->password);
            }

            if($request->has('birth_date')) {
                $member->birth_date = date('Y-m-d', strtotime($request->birth_date));
            }



            $member->save();
        }

        return response()->json($data, 200);
    }
}
