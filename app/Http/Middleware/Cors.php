<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Origin', '*')
            ->header('Allow', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Credentials', 'true')
            ->header('Access-Control-Allow-Headers', 'Access-Control-Allow-Origin, Origin, X-Requested-With, Content-Type, Accept')
            ->header('Access-Control-Expose-Headers', 'Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Credentials, Access-Control-Allow-Headers');
    }
}
