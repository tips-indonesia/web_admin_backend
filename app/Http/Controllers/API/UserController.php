<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\MemberList;
use App\SlotList;
use App\Http\Controllers\SMSSender;

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
                if($member_list->profil_picture){
                    $member_list->profil_picture = url('/image/profil_picture').'/'.$member_list->profil_picture;

                }
                $member_list->money = $this->getMoney($member_list->id);
                $data = array(
                    'err' => null,
                    'result' => $member_list
                );
            }
        }

        return response()->json($data, 200);
    }

    private function generateCode($n){
        return rand(10**($n - 1), 10**$n - 1);
    }

    function register(Request $request) {
        $member_list = MemberList::where('mobile_phone_no', $request->mobile_phone_no)->first();

        if(9 >= sizeof($request->mobile_phone_no) || sizeof($request->mobile_phone_no) >= 13) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Nomor handphone tidak valid'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        if($member_list != null && $member_list->sms_code == -1) {
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
//            $member_list->name = $request->name;
            $member_list->first_name = $request->first_name;

            if($request->has('last_name')) {
                if($request->last_name != "" && $request->last_name != null){
                    $member_list->last_name = $request->last_name;
                }
            }

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
            
            $sms_code = $this->generateCode(6); // 6 Random code generated

            $member_list->sms_code = $sms_code;

            $member_list->save();
            unset($member_list['password']);

            $out = SMSSender::kirim($request->mobile_phone_no, rawurlencode("TIPS App: Your code is " . $sms_code));

            $member_list->money = $this->getMoney($member_list->id);

            $data = array(
                'err' => null,
                'result' => $member_list
            );

        }

        return response()->json($data, 200);

    }

    function deviceRegisterOrLogin(Request $request) {
        $dev_identifier = 'dev-' . $request->mobile_phone_no;
        $member_list = MemberList::where('mobile_phone_no', $dev_identifier)->first();

        if($member_list != null)
            $data = array(
                'err' => null,
                'result' => $member_list
            );
        else {
            $member_list = new MemberList;
            $member_list->mobile_phone_no = $dev_identifier;
            $member_list->first_name = $dev_identifier;
            $member_list->last_name = "";
            $member_list->password = bcrypt($dev_identifier);
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
            $member_list->money = $this->getMoney($member_list->id);

            $data = array(
                'err' => null,
                'result' => $member_list
            );

        }

        return response()->json($data, 200);

    }

    public function verifyPhoneNumber(Request $request){
        $member_list = MemberList::where('mobile_phone_no', $request->mobile_phone_no)->first();
        if(!$member_list){
            // Kasus: member dengan no hp bersangkutan tidak terdaftar pada basis data
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Nomor handphone tidak terdaftar'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        $isSMSCodeValid = $member_list->sms_code == $request->sms_code;
        if($isSMSCodeValid){
            // Kasus: kode sms sesuai dengan code pada basis data 
            $member_list->sms_code = -1;
            $member_list->save();
            $data = array(
                'err' => null,
                'result' => true
            );
        }else if($member_list->sms_code == -1){
            // Kasus: sms code sudah pernah terverifikasi sebelumnya
            $data = array(
                'err' => [
                    'code' => 1,
                    'message' => "Your phone number has verified"
                ],
                'result' => null
            );
        }else{
            // Kasus: kode sms verifikasi tidak sesuai dengan yang ada pada basis data
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => "SMS Code is invalid"
                ],
                'result' => null
            );
        }

        return response()->json($data, 200);
    }

    public function resendSMSCode(Request $request){
        $member_list = MemberList::where('mobile_phone_no', $request->mobile_phone_no)->first();
        if(!$member_list){
            // Kasus: member dengan no hp bersangkutan tidak terdaftar pada basis data
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Nomor handphone tidak terdaftar'
                ],
                'result' => null
            );
        }else if($member_list->sms_code == -1){
            // Kasus: sms code sudah pernah terverifikasi sebelumnya
            $data = array(
                'err' => [
                    'code' => 1,
                    'message' => "Your phone number has verified"
                ],
                'result' => null
            );
        }else if($member_list->sms_code == null){
            // Kasus: sms code masih null di basis data (belum pernah di assign)
            $sms_code = $this->generateCode(6);
            $member_list->sms_code = $sms_code;
            $member_list->save();

            $pn = $request->mobile_phone_no;
            $sc = $sms_code;
            $out = SMSSender::kirim($pn, rawurlencode("TIPS App: Your code is " . $sc));

            $data = array(
                'err' => [
                    'code' => 1,
                    'message' => "Your phone number has verified"
                ],
                'result' => null
            );
        }else{

            $sms_code = $this->generateCode(6);
            $member_list->sms_code = $sms_code;
            $member_list->save();

            $pn = $request->mobile_phone_no;
            $sc = $sms_code;
            $out = SMSSender::kirim($pn, rawurlencode("TIPS App: Your code is " . $sc));

            $data = array(
                'err' => null,
                'result' => "SMS Sent to " . $request->mobile_phone_no
            );
        }

        return response()->json($data, 200);
    }

    private function microtime_float(){
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    /*
        {
            "name": "rio",
            "fb_token": "aaazzz",
            "uniq_social_id": "11223",
            "email": "rio@aa.aa", // opsional
            "birth_date": "sama seperti register biasa", // opsional
            "id_city": "bandung", // opsional
            "address": "cisitu", // opsional
        }
     */
    function actionFB(Request $request) {
        $member_list = MemberList::where('fb_token', $request->fb_token)->first();
        if($member_list != null) {
            $data = array(
                'err' => null,
                'result' => $member_list
            );
        } else {
            $member_list = MemberList::where('uniq_social_id', $request->uniq_social_id)->first();

            if($member_list == null)
                $member_list = new MemberList;

            $member_list->registered_date = date('Y-m-d');
            $member_list->fb_token = $request->fb_token;
            $member_list->uniq_social_id = $request->uniq_social_id;

            // default name
            $member_list->first_name = "Twitter user: " . $request->uniq_social_id;

            if($request->has('first_name')) {
                $member_list->first_name = $request->first_name;
            }

            if($request->has('last_name')) {
                $member_list->last_name = $request->last_name;
            }

            if($request->has('email')) {
                $member_list->email = $request->email;
            }

            if($request->has('sex')) {
                $member_list->sex = $request->sex;
            }

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
            $member_list = MemberList::where('fb_token', $request->fb_token)->first();
            $member_list->money = $this->getMoney($member_list->id);

            $data = array(
                'err' => null,
                'result' => $member_list
            );
        }

        return response()->json($data, 200);
    }

    /*
        {
            "name": "rio",
            "twitter_token": "aaazzz",
            "uniq_social_id": "11223",
            "email": "rio@aa.aa", // opsional
            "birth_date": "sama seperti register biasa", // opsional
            "id_city": "bandung", // opsional
            "address": "cisitu", // opsional
        }
     */
    function actionTwitter(Request $request) {
        $member_list = MemberList::where('twitter_token', $request->twitter_token)->first();
        if($member_list != null) {
            $data = array(
                'err' => null,
                'result' => $member_list
            );
        } else {
            $member_list = MemberList::where('uniq_social_id', $request->uniq_social_id)->first();

            if($member_list == null)
                $member_list = new MemberList;

            $member_list->registered_date = date('Y-m-d');
            $member_list->twitter_token = $request->twitter_token;
            $member_list->uniq_social_id = $request->uniq_social_id;

            // default name
            $member_list->first_name = "Twitter user: " . $request->uniq_social_id;

            if($request->has('first_name')) {
                $member_list->first_name = $request->first_name;
            }

            if($request->has('last_name')) {
                $member_list->last_name = $request->last_name;
            }

            if($request->has('email')) {
                $member_list->email = $request->email;
            }

            if($request->has('sex')) {
                $member_list->sex = $request->sex;
            }

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
            $member_list = MemberList::where('twitter_token', $request->twitter_token)->first();
            $member_list->money = $this->getMoney($member_list->id);

            $data = array(
                'err' => null,
                'result' => $member_list
            );
        }

        return response()->json($data, 200);
    }

    function getMoney($id){
        $my_slots = SlotList::where('id_member', $id)->where('id_slot_status', 7)->get();
        return 0;

        $sum_money = 0.00;
        foreach ($my_slots as $slot)
            $sum_money += $slot->sold_baggage_space * $slot->slot_price_kg;

        return $sum_money;
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
            if($request->has('first_name')) {
                if($request->first_name != null && $request->first_name != ''){
                    $member->first_name = $request->first_name;
                }
            }

            if($request->has('last_name')) {
                if($request->last_name != null && $request->last_name != ''){
                    $member->last_name = $request->last_name;
                }
            }

            if($request->has('email')) {
                if($request->email != null && $request->email != '') {
                    $member->email = $request->email;
                }
            }

            if($request->has('sex')) {
                if($request->sex != null && $request->sex != '') {
                    $member->sex = $request->sex;
                }
            }

            if($request->has('mobile_phone_no')) {
                if($request->mobile_phone_no != null && $request->mobile_phone_no != '') {
                    $member->mobile_phone_no = $request->mobile_phone_no;
                }
            }

            if($request->has('password')) {
                if($request->password != null && $request->password != '') {
                    $member->password = bcrypt($request->password);
                }
            }

            if($request->has('birth_date')) {
                if($request->birth_date != null && $request->birth_date != '') {
                    $member->birth_date = date('Y-m-d', strtotime($request->birth_date));
                }
            }

            if($request->has('profil_picture')) {
                if($request->profil_picture != null && $request->profil_picture != '') {
                    $file = $request->file('profil_picture');

                    $dataImg = $file;
                    $t = microtime(true);
                    $micro = sprintf("%06d", ($t - floor($t)) * 1000000);
                    $timestamp = date('YmdHis' . $micro, $t) . "_" . rand(0, 1000);

                    $ext_file = $dataImg->getClientOriginalExtension();
                    $name_file = $timestamp . '_img_item.' . $ext_file;
                    $path_file = public_path() . '/image/profil_picture/';

                    if ($dataImg->move($path_file, $name_file)) {
                        $member->profil_picture = $name_file;
                    }
                }
            }



            $member->save();
        }
        unset ($member['password']);
        if($member->profil_picture){
            $member->profil_picture = url('/image/profil_picture').'/'.$member->profil_picture;

        }
        return response()->json($member, 200);
    }
}
