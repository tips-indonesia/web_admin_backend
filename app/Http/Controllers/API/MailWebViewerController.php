<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MemberList;

class MailWebViewerController extends Controller
{
    public function showResetPassword($token){
    	return view('mail_web_viewer.reset_password', [
    		"reset_password_token" => $token
    	]);
    }

    public function doResetPassword(Request $req){
    	$reset_password_token 	= $req->token;
    	$new_password 			= $req->password;

        $user = MemberList::where('reset_password_token', $reset_password_token)->first();
        if(!$user){
            $data = array(
                'err' => [
                    "code": 404,
                    "message": "user tidak ditemukan"
                ],
                'result' => null
            );

            return response()->json($data, 200); 
        }

        $user->password = bcrypt($new_password);
        $user->reset_password_token = null;
        $user->save();

        return view('mail_web_viewer.reset_password_success', [
            $data = array(
                'err' => null,
                'result' => "Reset password berhasil!"
            );

            return response()->json($data, 200);
        ]);
    }
}
