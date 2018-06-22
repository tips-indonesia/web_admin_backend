<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddWorkerAbilityController extends Controller
{
     public function index() {
    	return view('admin.addworkerability.index');
    }
}
