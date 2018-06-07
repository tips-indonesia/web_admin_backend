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

        return $next($request);
    }
}