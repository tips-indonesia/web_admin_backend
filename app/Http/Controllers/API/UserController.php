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
