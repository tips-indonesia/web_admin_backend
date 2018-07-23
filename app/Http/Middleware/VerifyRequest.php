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
        if($request->path() == "api/qrcodeX") {
            return $next($request);
        }

        if($request->path() == "api/payment/inquiry") {
            return $next($request);
        }

        if($request->path() == "api/payment/payment") {
            return $next($request);
        }
        
        $kindApp = $request->header('app-kind');
        if(!$request->has('app-kind') && (!$kindApp || ($kindApp != 'android' && $kindApp != 'web-app' && $kindApp != 'ios'))){
            $data = array(
                'err' => [
                    'code' => "405",
                    'message' => 'your apps has been outdated, update your app now!'
                ],
                'result' => null
            );

            return response()->json($data, 200);
        }

        return $next($request);
    }
}
