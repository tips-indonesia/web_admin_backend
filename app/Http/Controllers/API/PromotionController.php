<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promotion;
use App\MemberList;
use App\Banner;
use Illuminate\Support\Facades\URL;
use DB;

class PromotionController extends Controller
{
    public function getPromo(Request $req) {
    	if ($req->id_user) {
            $data = array(
                'err' => [
                    "code" => 400,
                    "message" => "All parameter are required!"
                ],
                'result' => null
            );

            return response()->json($data, 200);
    	}

		$user = MemberList::find($req->id_user);
        if(!$user){
            $data = array(
                'err' => [
                    "code" => 404,
                    "message" => "User not found"
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        if($user->promotion_id_used){
            $promo = $this->findPromoOrFalse($user->promotion_id_used);
            if($promo){
                $data = array(
                    'err' => null,
                    'result' => [
                        'promo' => [],
                    ]
                );

                return response()->json($data, 200);
            }
        }

    	$promos = Promotion::all();
        foreach ($promos as $promo) {
            $promo->img_src = URL::to('storage/promotions/' . $promo->file_name);
        }
    	$data = array(
    		'err' => null,
    		'result' => [
    			'promo' => $promos,
    		]
    	);

    	return response()->json($data, 200);
    }

    public function postSelectPromo(Request $req){
        $id_user = $req->id_user;
        $id_promo = $req->id_promo;

        if(!$id_user || !$id_promo){
            $data = array(
                'err' => [
                    "code" => 400,
                    "message" => "All parameter are required!"
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        $user = MemberList::find($id_user);
        if(!$user){
            $data = array(
                'err' => [
                    "code" => 404,
                    "message" => "User not found"
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        $promo = $this->findPromoOrFalse($id_promo)
        if(!$promo){
            $data = array(
                'err' => [
                    "code" => 404,
                    "message" => "Promo not found, or has beed expired"
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        $user->promotion_id_used = $id_promo;
        $user->save();

        $data = array(
            'err' => null,
            'result' => [
                "message" => "Promo has beed applied"
            ]
        );

        return response()->json($data, 200);
    }

    private function findPromoOrFalse($id_promo){
        $promo = Promotion::find($id_promo);
        if(!$promo)
            return false;
        
        return $promo;
    }

    // public function getIklan() {
    // 	if (isset($_GET['id_user'])) {
    // 		// Dunno what to do
    // 	} else {
    // 		// Dunno what to do
    // 	}

    // 	$iklans = Banner::all();
    // 	$res = array();

    //     foreach($iklans as $promo) {
    //         $dum = [
    //             'id' => $promo->id,
    //             'start_date' => $promo->start_date,
    //             'end_date' => $promo->end_date,
    //             'header' => $promo->header,
    //             'template_type' => $promo->template_type,
    //             'discount' => $promo->discount,
    //             'img_src' => URL::to('storage/promotions/'.$promo->filename),
    //         ];
    //         array_push($res, $dum);
    //     }

    // 	$data = array(
    // 		'err' => null,
    // 		'result' => [
    // 			'iklan' => $res
    // 		]
    // 	);

    // 	return response()->json($data, 200);	
    // }
}
