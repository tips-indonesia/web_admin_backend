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

class MatchTest extends Controller
{
    public function index()
    {
    	$u = new UtilityController;
    	$u->CekDataAntrian();
        return view('admin.match.index');
    }
}
