<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promotion;
use App\PromotionMember;
use App\MemberList;
use App\Banner;
use Illuminate\Support\Facades\URL;
use DB;

class PromotionController extends Controller
{
    public function getPromo(Request $req) {
    	if (!$req->id_user) {
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

        $promo = $this->findPromoOrFalse($id_promo);
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

        $new_promo_member = PromotionMember::create([
            'id_promotion' => $promo->id,
            'id_member' => $user->id
        ]);

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

    public function getReferalCodeDetail(Request $req){
        if(!$req->ref_code)
            return response()->json([
                'err' => [
                    "code" => 400,
                    "message" => "paramter ref_code is required"
                ],
                'result' => null
            ], 200);

        $user = MemberList::where('ref_code', $req->ref_code)->first();
        if(!$user)
            return response()->json([
                'err' => [
                    "code" => 404,
                    "message" => "ref code not found"
                ],
                'result' => null
            ], 200);

        $data = [
            'err' => null,
            'result' => [
                'ref_code' => $req->ref_code,
                'amount' => 50000
            ]
        ];
        return response()->json($data, 200);
    }
}
