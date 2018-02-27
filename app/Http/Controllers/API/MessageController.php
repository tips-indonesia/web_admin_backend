<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function getPesan(Request $req){
    	if(!$req->id){
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
				"messages" => [
					[
						"id" => 1,
						"nama_pengirim" => "TIPS",
						"tanggal" => date('Y-m-d h:i:s'),
						"subjek" => "Welcome onboard",
						"isi" => "lorem ipsum dolor sit amet consectetur adipiscing elit, yaaaaa"
					],
					[
						"id" => 2,
						"nama_pengirim" => "TIPS",
						"tanggal" => date('Y-m-d h:i:s'),
						"subjek" => "Welcome onboard 2",
						"isi" => "2 lorem ipsum dolor sit amet consectetur adipiscing elit, yaaaaa 2 "
					],
					[
						"id" => 3,
						"nama_pengirim" => "TIPS",
						"tanggal" => date('Y-m-d h:i:s'),
						"subjek" => "Welcome onboard 3",
						"isi" => "3 lorem ipsum dolor sit amet consectetur adipiscing elit, yaaaaa"
					],
					[
						"id" => 4,
						"nama_pengirim" => "TIPS",
						"tanggal" => date('Y-m-d h:i:s'),
						"subjek" => "Welcome onboard 4",
						"isi" => "4 lorem ipsum dolor sit amet consectetur adipiscing elit, yaaaaa 4"
					]
				]
            ]
        );

        return response()->json($data, 200);
    }
}
