<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DualLanguage;
use App\UpdateLanguage;
use App\ErrorDualLanguage;
use App\User;

class DualLanguageController extends Controller
{
    public function all() {
        $langs = DualLanguage::select('text_key', 'text_id', 'text_en', 'id_page_name')->get()->toArray();
        $error_langs = ErrorDualLanguage::select('text_key', 'text_id', 'text_en', 'id_page_name')->get()->toArray();
        if (count($langs) == 0) {
            $data = [
                'err' => [
                    'code' => '404',
                    'message' => 'No Dual Language Data Found'
                ],
                'result' => null
            ];
        } else {
            $data = [
                'err' => null,
                'result' => array_merge($langs, $error_langs)
            ];
        }

        return response()->json($data, 200);
    }

    public function flag() {
        $currentFlag = UpdateLanguage::select('seq')->first();

        if (!$currentFlag) {
            $data = [
                'err' => [
                    'code' => 500,
                    'message' => 'Oops... Someting Error'
                ],
                'result' => null
            ];
        } else {
            $data = [
                'err' => null,
                'result' => $currentFlag
            ];
        }

        return response()->json($data, 200);
    }

    public function change_active_lang(Request $request) {
        if (!isset($request['user_id'])) {
            return response()->json([
                'err' => [
                    'code' => 400,
                    'message' => 'user_id can\'t be null'
                ],
                'result' => null
            ], 200);
        }
        if (!isset($request['lang_active'])) {
            return response()->json([
                'err' => [
                    'code' => 400,
                    'message' => 'lang_active can\'t be null'
                ],
                'result' => null
            ], 200);
        }

        $user = User::find($request['user_id']);
        if (!$user) {
            return response()->json([
                'err' => [
                    'code' => 401,
                    'message' => 'user not found'
                ],
                'result' => null
            ]);
        }
        $user->lang_active = $request['lang_active'];
        $user->save();

        return response()->json([
            'err' => null,
            'result' => 1
        ]);
    }

    public function get_active_lang($userid) {
        $user = User::find($userid);
        if (!$user) {
            return response()->json([
                'err' => [
                    'code' => 401,
                    'message' => 'user not found'
                ],
                'result' => null
            ]);
        }
        return response()->json([
            'err' => null,
            'result' => $user->lang_active
        ]);
    }
}