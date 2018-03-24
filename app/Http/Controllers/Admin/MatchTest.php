<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Insurance;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Auth;

class MatchTest extends Controller
{
    public function index()
    {
    	$data['id'] = Auth::id();
        return view('admin.match.index', $data);
    }
}
