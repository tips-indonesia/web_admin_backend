<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promotion;
use App\PromotionMember;
use App\MemberList;
use App\Banner;
use App\Referral;
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

    static public function getUserPromoOrNULL($id_user){
        if(!$id_user)
            return [
                'promo' => null,
                'reason' => 'User id null'
            ];

        $user = MemberList::find($id_user);
        if(!$user)
            return [
                'promo' => null,
                'reason' => 'User id = ' . $id_user . ' doesn\'t exist'
            ];

        $last_promo = PromotionMember::where('id_member', $id_user)->orderBy('id', 'desc')->first();
        if(!$last_promo)
            return [
                'promo' => null,
                'reason' => 'User id = ' . $id_user . ' never had any promotion'
            ];

        $end_date_promo = new \Carbon\Carbon($last_promo->promotion->end_date);
        $end_date_promo->hour(23)->minute(59)->second(59);
        if($end_date_promo->isPast())
            return [
                'promo' => null,
                'reason' => 'Last promo of user id = ' . $id_user . ' has been expired on ' . $end_date_promo
            ];

        return [
            'promo' => $last_promo->promotion,
            'reason' => null
        ];
    }

    public function testPromo2(){
        return PromotionController::getUserPromoOrNULL(2);
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

    public function getReferalAmount(Request $req){
        $ref_data = PromotionController::getSingleReferral();
        $amount = 0;

        if($ref_data)
            $amount = $ref_data->referred_amount;

        $data = [
            'err' => null,
            'result' => [
                'amount' => $amount
            ]
        ];
        return response()->json($data, 200);
    }

    public static function getSingleReferral(){
        $out = null;
        
        $ref_data = Referral::orderBy('id', 'desc')->first();
        if(!$ref_data)
            return $out;

        $end_date_promo = new \Carbon\Carbon($ref_data->end_date);
        $end_date_promo->hour(23)->minute(59)->second(59);

        if($ref_data && !$end_date_promo->isPast())
            $out = $ref_data;

        return $out;
    }
}
