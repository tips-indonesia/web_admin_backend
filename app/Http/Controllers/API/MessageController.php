<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    	$data = array(
    		"err" => null,
    		"result" => [
    			"id" => 1,
    			"nama_pengirim" => "TIPS",
    			"tanggal" => date('Y-m-d h:i:s'),
    			"subjek" => "welcome onboard",
    			"isi" => "The progress bar is coming in white colour on emulator, but when I run same code on htc, progress bar is coming in green color, and on G1 it is with yellow color. I want all in Yellow colour. How can I give Colour?? or is there any method by which I can use my own image for progress bar? I have tried android:progressDrawable='@drawable/progress_bar' in xml but its not working. Please help "
    		]
    	);

    	return response()->json($data, 200);
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
					],
					[
						"id" => 5,
						"nama_pengirim" => "TIPS",
						"tanggal" => date('Y-m-d h:i:s'),
						"subjek" => "Welcome onboard",
						"isi" => "lorem ipsum dolor sit amet consectetur adipiscing elit, yaaaaa"
					],
					[
						"id" => 6,
						"nama_pengirim" => "TIPS",
						"tanggal" => date('Y-m-d h:i:s'),
						"subjek" => "Welcome onboard 2",
						"isi" => "2 lorem ipsum dolor sit amet consectetur adipiscing elit, yaaaaa 2 "
					],
					[
						"id" => 7,
						"nama_pengirim" => "TIPS",
						"tanggal" => date('Y-m-d h:i:s'),
						"subjek" => "Welcome onboard 3",
						"isi" => "3 lorem ipsum dolor sit amet consectetur adipiscing elit, yaaaaa"
					],
					[
						"id" => 8,
						"nama_pengirim" => "TIPS",
						"tanggal" => date('Y-m-d h:i:s'),
						"subjek" => "Welcome onboard 4",
						"isi" => "4 lorem ipsum dolor sit amet consectetur adipiscing elit, yaaaaa 4"
					],
					[
						"id" => 9,
						"nama_pengirim" => "TIPS",
						"tanggal" => date('Y-m-d h:i:s'),
						"subjek" => "Welcome onboard",
						"isi" => "lorem ipsum dolor sit amet consectetur adipiscing elit, yaaaaa"
					],
					[
						"id" => 10,
						"nama_pengirim" => "TIPS",
						"tanggal" => date('Y-m-d h:i:s'),
						"subjek" => "Welcome onboard 2",
						"isi" => "2 lorem ipsum dolor sit amet consectetur adipiscing elit, yaaaaa 2 "
					],
					[
						"id" => 11,
						"nama_pengirim" => "TIPS",
						"tanggal" => date('Y-m-d h:i:s'),
						"subjek" => "Welcome onboard 3",
						"isi" => "3 lorem ipsum dolor sit amet consectetur adipiscing elit, yaaaaa"
					],
					[
						"id" => 12,
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
