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
            return view('mail_web_viewer.reset_password_success', [
            	"message" => "Gagal, user tidak ditemukan atau token reset password tidak berlaku lagi."
            ]);
        }

        $user->password = bcrypt($new_password);
        $user->reset_password_token = null;
        $user->save();

        return view('mail_web_viewer.reset_password_success', [
        	"message" => "Reset Password Success!"
        ]);
    }
}
