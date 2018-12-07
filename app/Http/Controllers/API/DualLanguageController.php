<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DualLanguage;
use App\UpdateLanguage;

class DualLanguageController extends Controller
{
    public function all() {
        $langs = DualLanguage::select('text_key', 'text_id', 'text_en', 'id_page_name')->get();

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
                'result' => $langs
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
}