<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
use App\MemberList;

class MessageController extends Controller
{

	public function getPesanSpesifik($id_user, $id_pesan){
		if(!$id_user){
            $data = array(
                "err" => [
                	"code" => 404,
                	"message" => "user tidak ditemukan"
                ],
                "result" => null
            );

            return response()->json($data, 200);
    	}

    	$user = MemberList::find($id_user);

		if(!$user){
            $data = array(
                "err" => [
                	"code" => 404,
                	"message" => "user tidak ditemukan"
                ],
                "result" => null
            );

            return response()->json($data, 200);
    	}

    	$message = Message::find($id_pesan);

    	if(!$message){
    		$data = array(
                "err" => [
                	"code" => 404,
                	"message" => "pesan tidak ditemukan"
                ],
                "result" => null
            );

            return response()->json($data, 200);
    	}

    	if($message->member_id != $id_user){
    		$data = array(
                "err" => [
                	"code" => 400,
                	"message" => "pesan tidak dapat dibuka"
                ],
                "result" => null
            );

            return response()->json($data, 200);
    	}

    	$data = array(
    		"err" => null,
    		"result" => $message
    	);

    	return response()->json($data, 200);
	}

	public static function sendMessageToUser($sender, $user, $subjek, $status, $message){
		if(!$user)
			return false;

		$message = Message::create([
			"member_id"	=> $user->id,
			"nama_pengirim" 	=> $sender,
			"subjek" 	=> $subjek,
			"status" 	=> $status,
			"message" 	=> $message
		]);

		return $message;
	}

	public function testMessage(Request $req){
		return MessageController::sendMessageToUser("TIPS", MemberList::find($req->user_id), "1", "Test Message", "lorem ipsum dolor sit amet");
	}

    public function getPesan($id_user){
    	if(!$id_user){
            $data = array(
                "err" => [
                	"code" => 404,
                	"message" => "user tidak ditemukan"
                ],
                "result" => null
            );

            return response()->json($data, 200);
    	}

    	$user = MemberList::find($id_user);
    	
		if(!$user){
            $data = array(
                "err" => [
                	"code" => 404,
                	"message" => "user tidak ditemukan"
                ],
                "result" => null
            );

            return response()->json($data, 200);
    	}

        $data = array(
            "err" => null,
            "result" => [
				"messages" => Message::where('member_id', $id_user)->get()
            ]
        );

        return response()->json($data, 200);
    }
}
