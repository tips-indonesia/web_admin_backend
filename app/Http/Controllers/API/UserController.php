<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\MemberList;
use App\SlotList;
use App\Http\Controllers\SMSSender;
use App\Http\Controllers\cURLFaker;
use App\Http\Controllers\WalletAll;

class UserController extends Controller
{

    public $USER_LOGIN_ERROR = [];
    public $USER_LOGIN_ERROR_CODE = [];

    public function loginAndGetStoreToken(Request $request) {
        $member_list = $this->loginByPhoneAndPassword($request->mobile_phone_no, $request->password);
        if (is_numeric($member_list)) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => $this->USER_LOGIN_ERROR[$member_list]
                ],
                'result' => null
            );
        } else {
            $member_list->createStoreToken();
            $data = array(
                'err' => null,
                'result' => [
                    'store_token' => $member_list->store_token
                ]
            );
        }

        return response()->json($data, 200);
    }

    public function logoutAndDropStoreToken(Request $request) {
        $stoken = $request->store_token;
        if (!$stoken) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => "store token not found"
                ],
                'result' => null
            );
            return response()->json($data, 200);
        }

        // store token is found but user not found
        $userByToken = $this->getUserFromStoreToken($stoken);
        if (is_numeric($userByToken))
            return $this->makeError($this->USER_LOGIN_ERROR_CODE[$userByToken], 
                $this->USER_LOGIN_ERROR[$userByToken]);

        $userByToken->store_token = null;
        $userByToken->save();

        $data = array(
            'err' => null,
            'result' => [
                'message' => "success"
            ]
        );

        return response()->json($data, 200);
    }

    public function getUserByStoreToken(Request $req) {
        // check store token parameter
        $stoken = $req->store_token;
        if (!$stoken) {
            $data = array(
                'err' => [
                    'code' => 400,
                    'message' => 'store_token is required'
                ],
                'result' => null
            );
            return response()->json($data, 200);
        }

        // check store token parameter
        $filters = $req->fields;
        if (!$filters) {
            $data = array(
                'err' => [
                    'code' => 400,
                    'message' => 'fields is required'
                ],
                'result' => null
            );
            return response()->json($data, 200);
        }

        // store token is found but user not found
        $userByToken = $this->getUserFromStoreToken($stoken);
        if (is_numeric($userByToken))
            return $this->makeError($this->USER_LOGIN_ERROR_CODE[$userByToken], 
                $this->USER_LOGIN_ERROR[$userByToken]);

        $userByToken = $this->getDerivedUserInformation($userByToken);

        // store token is found and user is found
        $data = array(
            'err' => null,
            'result' => $userByToken->filter_data($userByToken, $filters)
        );
        return response()->json($data, 200);
    }

    function makeError($code, $msg){
        $data = array(
            'err' => [
                'code' => $code,
                'message' => $msg
            ],
            'result' => null
        );
        return response()->json($data, 200);
    }

    function getUserFromStoreToken($store_token){

        // error required parameters is not found
        $this->USER_LOGIN_ERROR[-11]        = "Store token tidak boleh kosong";
        $this->USER_LOGIN_ERROR_CODE[-11]   = 403;
        if (!$store_token) {
            return -11;
        }

        // error required parameters is not found
        $this->USER_LOGIN_ERROR[-12]        = "User tidak ditemukan";
        $this->USER_LOGIN_ERROR_CODE[-12]   = 404;
        $userByToken = MemberList::where('store_token', $store_token)->first();
        if (!$userByToken) {
            return -12;
        }

        return $userByToken;
    }

    function loginByPhoneAndPassword($pn, $ps){

        // error required parameters is not found
        $this->USER_LOGIN_ERROR[-1]         = "Nomor handphone dan password tidak boleh kosong";
        $this->USER_LOGIN_ERROR_CODE[-1]    = 403;
        if (!$pn && !$ps) {
            return -1;
        }

        // error phone number required parameter is not found
        $this->USER_LOGIN_ERROR[-2]         = "Nomor handphone tidak boleh kosong";
        $this->USER_LOGIN_ERROR_CODE[-2]    = 403;
        if (!$pn) {
            return -2;
        }

        // error password required parameter is not found
        $this->USER_LOGIN_ERROR[-3]         = "Password tidak boleh kosong";
        $this->USER_LOGIN_ERROR_CODE[-3]    = 403;
        if (!$ps) {
            return -3;
        }

        // error user not found
        $this->USER_LOGIN_ERROR[-4]         = "Nomor handphone tidak ditemukan";
        $this->USER_LOGIN_ERROR_CODE[-4]    = 404;
        $member_list = MemberList::where('mobile_phone_no', $pn)->first();
        if($member_list == null) {
            return -4;
        }

        // error password incorrect
        $this->USER_LOGIN_ERROR[-5]         = "Password Salah";
        $this->USER_LOGIN_ERROR_CODE[-5]    = 400;
        if(!Hash::check($ps, $member_list->password)) {
            return -5;
        }

        // +--------------------------
        // | success
        // |
             return $member_list;
        // |
        // | end success
        // +--------------------------
    }

    function getDerivedUserInformation(MemberList $member_list){

        // | unset password
        unset($member_list['password']);

        // | set profile picture relative url
        if($member_list->profil_picture){
            $member_list->profil_picture = url('/image/profil_picture').'/'.$member_list->profil_picture;
        }

        // | set referral code if not exist
        if($member_list->ref_code == null){
            $member_list->ref_code = $this->generateReferalCode($member_list);
            $member_list->save();
        }

        // check if guest, return the name
        $output_array = [];
        preg_match_all("/dev-.*/", $member_list->mobile_phone_no, $output_array);
        if(sizeof($output_array) > 0){
            $member_list->first_name        = "TIPS";
            $member_list->last_name         = "";
            $member_list->email             = "tips@tips.com";
            $member_list->mobile_phone_no   = "012345678";
        }

        // | wtf is this
        $member_list->is_member = true;

        // | set the money
        $member_list->money = WalletAll::getWalletAmount($member_list->id);

        return $member_list;
    }

    //
    public function login(Request $request) {
        $member_list = $this->loginByPhoneAndPassword($request->mobile_phone_no, $request->password);
        if (is_numeric($member_list)) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => $this->USER_LOGIN_ERROR[$member_list]
                ],
                'result' => null
            );
        } else {
            // set token of login
            if($request->has('token')) {
                $member_list->token = $request->token;
            }
            $member_list->save();

            $data = array(
                'err' => null,
                'result' => $this->getDerivedUserInformation($member_list)
            );
        }

        return response()->json($data, 200);
    }

    private function generateCode($n){
        return rand(10**($n - 1), 10**$n - 1);
    }

    private function generateReferalCode($user){
        $three_random_number = sprintf("%03d", rand(0, 999));
        return strtolower(substr($user->first_name, 0, 3)) . strtolower(substr($user->last_name, 0, 1)) . $three_random_number . 't';
    }

    function register(Request $request) {
        $member_list = MemberList::where('mobile_phone_no', $request->mobile_phone_no)->first();

        $pnlen = strlen($request->mobile_phone_no);
        if((9 + 2) > $pnlen || $pnlen > (13 + 2)) {
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

            if($member_list->ref_code == null){
                $member_list->ref_code = $this->generateReferalCode($member_list);
                $member_list->save();
            }

            if($request->has('ref_code')) {
                $member_list->register_by = "REF:" . $request->ref_code;
            }

            $member_list->save();
            unset($member_list['password']);

            $out = SMSSender::kirim($request->mobile_phone_no, rawurlencode("TIPS App: Your code is " . $sms_code));

            $member_list->money = WalletAll::getWalletAmount($member_list->id);

            $data = array(
                'err' => null,
                'result' => $member_list
            );

        }

        return response()->json($data, 200);

    }

    function sendEmailRegistration($member_list){
        $bsc = new cURLFaker;
        $email = $member_list->email;
        $nama = $member_list->first_name . ' ' . $member_list->last_name;

        $debugemail = '';
        if($email){
            $debugemail = "sendMailRegistration($email, $nama)";
            $bsc->sendMailRegistration($email, $nama);
        }
    }

    function deviceRegisterOrLogin(Request $request) {
        $dev_identifier = 'dev-' . $request->mobile_phone_no;
        $member_list = MemberList::where('mobile_phone_no', $dev_identifier)->first();

        if($member_list != null)
            $data = array(
                'err' => null,
                'result' => $this->getDerivedUserInformation($member_list)
            );
        else {
            $member_list = new MemberList;
            $member_list->mobile_phone_no = $dev_identifier;
            $member_list->first_name = $dev_identifier;
            $member_list->last_name = "device";
            $member_list->password = bcrypt($dev_identifier);
            $member_list->registered_date = date('Y-m-d');

            // save if the device has token
            if($request->has('token')) {
                $member_list->token = $request->token;
            }

            $member_list->save();
            unset($member_list['password']);
            $member_list->money = WalletAll::getWalletAmount($member_list->id);;

            $data = array(
                'err' => null,
                'result' => $member_list
            );
        }

        return response()->json($data, 200);

    }

    static function getAnonOrRegister($anon_id, $token){
        $dev_identifier = 'dev-' . $anon_id;
        $member_list = MemberList::where('mobile_phone_no', $dev_identifier)->first();

        if($member_list == null){
            $member_list = new MemberList;
            $member_list->mobile_phone_no = $dev_identifier;
            $member_list->first_name = $dev_identifier;
            $member_list->last_name = "device";
            $member_list->password = bcrypt($dev_identifier);
            $member_list->registered_date = date('Y-m-d');

            // save if the device has token
            if($token != null) {
                $member_list->token = $token;
            }

            $member_list->save();
            unset($member_list['password']);
            $member_list->money = WalletAll::getWalletAmount($member_list->id);
        }

        return $member_list;
    }

    public function testAnonRegisterLogin(Request $req){
        return UserController::getAnonOrRegister($req->id, null);
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
            $member_list->create_transaction_ref();
            $member_list->save();
            $this->sendEmailRegistration($member_list);
            $data = array(
                'err' => null,
                'result' => true
            );
        }else if($member_list->sms_code == -1){
            // Kasus: sms code sudah pernah terverifikasi sebelumnya
            $data = array(
                'err' => [
                    'code' => 1,
                    'message' => "Your phone number has been verified, please login using this number"
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

    public function sendSMSCodeForFBTwitterRegistered(Request $request){
        $member_list = MemberList::where('mobile_phone_no', $request->mobile_phone_no)->first();
        $member_list_social = MemberList::where('fb_token', $request->uniq_social_id)
                              ->orWhere('twitter_token', $request->uniq_social_id)->first();
        if(!$member_list){
            if(!$member_list_social){
                $data = array(
                    'err' => [
                        'code' => 404,
                        'message' => 'User tidak ditemukan, harap hubungi TIPS Administrator'
                    ],
                    'result' => null
                );
                return response()->json($data, 200);
            }

            $member_list_social->mobile_phone_no = $request->mobile_phone_no;
            $member_list_social->save();
        }

        return $this->resendSMSCode($request);
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
        }else if($member_list->sms_code == null){
            // Kasus: sms code masih null di basis data (belum pernah di assign)
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
        $member_list = MemberList::where('fb_token', $request->uniq_social_id)->first();
        if($member_list != null) {

            if($member_list->profil_picture){
                $member_list->profil_picture = url('/image/profil_picture').'/'.$member_list->profil_picture;
            }

            $data = array(
                'err' => null,
                'result' => $member_list
            );
        } else {
            if($member_list == null)
                $member_list = new MemberList;

            $member_list->registered_date = date('Y-m-d');
            $member_list->fb_token = $request->uniq_social_id;

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

            if($member_list->ref_code == null){
                $member_list->ref_code = $this->generateReferalCode($member_list);
                $member_list->save();
            }

            $member_list->save();
            $member_list->money = WalletAll::getWalletAmount($member_list->id);;
            
            if($member_list->profil_picture){
                $member_list->profil_picture = url('/image/profil_picture').'/'.$member_list->profil_picture;
            }

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
        $member_list = MemberList::where('twitter_token', $request->uniq_social_id)->first();
        if($member_list != null) {

            if($member_list->profil_picture){
                $member_list->profil_picture = url('/image/profil_picture').'/'.$member_list->profil_picture;
            }
            
            $data = array(
                'err' => null,
                'result' => $member_list
            );
        } else {
            if($member_list == null)
                $member_list = new MemberList;

            $member_list->registered_date = date('Y-m-d');
            $member_list->twitter_token = $request->uniq_social_id;

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
            
            if($member_list->ref_code == null){
                $member_list->ref_code = $this->generateReferalCode($member_list);
                $member_list->save();
            }

            $member_list->save();
            $member_list->money = WalletAll::getWalletAmount($member_list->id);
            
            if($member_list->profil_picture){
                $member_list->profil_picture = url('/image/profil_picture').'/'.$member_list->profil_picture;
            }

            $data = array(
                'err' => null,
                'result' => $member_list
            );
        }

        return response()->json($data, 200);
    }

    function update_profile(Request $request) {
        $member = MemberList::find($request->member_id);


        if($request->has('mobile_phone_no')) {
            if($request->mobile_phone_no != null && $request->mobile_phone_no != '') {
                $member_no_hp = MemberList::where('mobile_phone_no', $request->mobile_phone_no)->first();
                if($member_no_hp && $member_no_hp->id != $member->id && $member_no_hp->sms_code == -1){
                    $data = array(
                        'err' => [
                            'code' => 0,
                            'message' => 'Nomor handphone telah terdaftar'
                        ],
                        'result' => null
                    );
                    return response()->json($data, 200);
                }
            }
        }

        $pnlen = strlen($request->mobile_phone_no);
        if((9 + 2) > $pnlen || $pnlen > (13 + 2)) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Nomor handphone tidak valid'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        if($member == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'User Id tidak ditemukan'
                ],
                'result' => null
            );
            return response()->json($data, 200);
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
                    if(MemberList::where('email', $request->email)->where('email', '!=', $member->email)->first()) {
                        $data = array(
                            'err' => [
                                'code' => 0,
                                'message' => 'Error: email sudah digunakan'
                            ],
                            'result' => null
                        );
                        return response()->json($data, 200);
                    }else{
                        $member->email = $request->email;
                    }
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

                    $ext_file = $dataImg->guessExtension();
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
    public function verifyPhoneNumberForFacebookTwitter(Request $req){
        $memberId = $req->member_id;
        $phoneNo = $req->mobile_phone_no;
        $uniqSocialId = $req->uniq_social_id;
        $fbToken = $req->fb_token;
        $twitterToken = $req->twitter_token;
        $smsCode = $req->sms_code;

        $isPhoneRegistered = true;
        // 1. Cek apakah pengguna dengan no HP bersangkutan telah terdaftar
        $member_list = MemberList::where('mobile_phone_no', $phoneNo)->first();
        if(!$member_list){
            // 1 => False. Jika tidak terdaftar maka ambil user fb/twitter 
            //      yang sudah di daftarkan sebelumnya.
            //      MemberList pada state ini tidak akan null,
            //      karena user telah didaftarkan saat pertama kali
            //      auth'd menggunakan facebook/twitter
            $member_list = MemberList::find($memberId);
            $isPhoneRegistered = false;
        }else{
            if($fbToken){
                $member_list_will_delete = MemberList::where('fb_token', $uniqSocialId)
                                           ->where('mobile_phone_no', null)->first();
                if($member_list_will_delete)
                    $member_list_will_delete->delete();
            }

            if($twitterToken){
                $member_list_will_delete = MemberList::where('twitter_token', $uniqSocialId)
                                           ->where('mobile_phone_no', null)->first();
                if($member_list_will_delete)
                    $member_list_will_delete->delete();
            }
        }

        $isSMSCodeValid = ($member_list->sms_code == $smsCode) || ($member_list->sms_code == -1);

        if($isSMSCodeValid){
            $member_list->sms_code = -1;
            if($isPhoneRegistered){
                if($fbToken)
                    $member_list->fb_token = $uniqSocialId;

                if($twitterToken)
                    $member_list->twitter_token = $uniqSocialId;

            }else{
                $member_list->mobile_phone_no = $phoneNo;
            }

            $member_list->create_transaction_ref();
            $member_list->save();
            $this->sendEmailRegistration($member_list);

            if($member_list->profil_picture){
                $member_list->profil_picture = url('/image/profil_picture').'/'.$member_list->profil_picture;
            }

            $data = array(
                'err' => null,
                'result' => $member_list
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

    public function verifyFBTwitterPN(Request $req){
        $memberId = $req->member_id;
        $phoneNo = $req->mobile_phone_no;

        $member_pn = MemberList::where('mobile_phone_no', $phoneNo)->where('sms_code', -1)->first();
        if($member_pn){
            $data = array(
                'err' => [
                    'code' => 401,
                    'message' => '[PNVFD] terdapat kesalahan, silahkan hubungi administrator TIPS'
                ],
                'result' => null
            );
            return response()->json($data, 200);
        }

        if($memberId == null || $phoneNo == null){
            $data = array(
                'err' => [
                    'code' => 400,
                    'message' => 'paramter member id dan phone no wajib diisi'
                ],
                'result' => null
            );
            return response()->json($data, 200);
        }

        $member = MemberList::find($memberId);
        if(!$member){
            $data = array(
                'err' => [
                    'code' => 404,
                    'message' => '[USRNF] terdapat kesalahan, silahkan hubungi administrator TIPS'
                ],
                'result' => null
            );
            return response()->json($data, 200);
        }
        if($member->sms_code == -1){
            $data = array(
                'err' => [
                    'code' => 401,
                    'message' => '[USPVD] terdapat kesalahan, silahkan hubungi administrator TIPS'
                ],
                'result' => null
            );
            return response()->json($data, 200);
        }

        $member->mobile_phone_no = $phoneNo;
        $member->sms_code = $this->generateCode(6);
        $member->save();

        $out = SMSSender::kirim($phoneNo, rawurlencode("TIPS App: Your code is " . $member->sms_code));

        $data = array(
            'err' => null,
            'result' => [
                'mobile_phone_no' => $member->mobile_phone_no
            ]
        );
        return response()->json($data, 200);
    }
}
