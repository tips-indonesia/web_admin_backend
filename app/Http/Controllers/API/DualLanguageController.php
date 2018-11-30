<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DualLanguage;

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
}