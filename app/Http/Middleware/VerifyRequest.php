<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class VerifyRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        $kindApp = $request->header('app-kind');
        if(!$kindApp || ($kindApp != 'android' && $kindApp != 'web-app' && $kindApp != 'ios')){
            $data = array(
                'err' => [
                    'code' => "405",
                    'message' => 'your apps has been outdated, update your app now!'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Origin', '*')
            ->header('Allow', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Credentials', 'true')
            ->header('Access-Control-Allow-Headers', 'Access-Control-Allow-Origin, Origin, X-Requested-With, Content-Type, app-kind, Accept')
            ->header('Access-Control-Expose-Headers', 'Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Credentials, Access-Control-Allow-Headers, app-kind');
    }
}
