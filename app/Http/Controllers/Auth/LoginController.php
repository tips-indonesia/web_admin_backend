<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function username()
    {
        return 'mobile_phone_no';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function logout(Request $request) {
        $request->session()->forget('officename');
        Auth::logout();

        return redirect('/admin');
    }

    public function authenticate(Request $request) {
        if (Auth::attempt([
            'mobile_phone_no' => $request->input('mobile_phone_no'),
            'password' => $request->input('password'),
            'status_member' => 1
        ])) {
            return redirect('/admin');
        } else {
            return back();
        }
    }
}
