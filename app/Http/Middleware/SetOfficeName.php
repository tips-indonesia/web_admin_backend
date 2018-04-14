<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\OfficeList;
use App\User;

class SetOfficeName
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
        $user = User::find(Auth::id());
        if ($user->id_office != null) {
            $office = OfficeList::find($user->id_office);
            session(['officename' => $office->name]);
        }
        if ($user->id == 1) {
            session(['officename' => 'Kantor Jakarta']);
        }
        return $next($request);
    }
}
