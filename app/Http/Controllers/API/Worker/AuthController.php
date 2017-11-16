<?php

namespace App\Http\Controllers\API\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\User;

class AuthController extends Controller
{
    //
    function login(Request $request) {
        $user = User::where('username', $request->username)->first();
        if($user == null) {
            $data = array(
                'err' => [
                    'code' => 0,
                    'message' => 'Username tidak ditemukan'
                ],
                'result' => null
            );
        } else {
            if(!Hash::check($request->password, $user->password)) {
                $data = array(
                    'err' => [
                        'code' => 0,
                        'message' => 'Password salah'
                    ],
                    'result' => null
                );


            } else {
                unset($user['password']);
                $data = array(
                    'err' => null,
                    'result' => $user
                );
            }
        }

        return response()->json($data, 200);
    }
}
