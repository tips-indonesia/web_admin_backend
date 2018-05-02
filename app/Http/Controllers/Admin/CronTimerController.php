<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CronTimer;
class CronTimerController extends Controller
{
    public function index() {
    	$data['datas'] = CronTimer::first();

    	return view('admin.crontimer.index', $data);
    }

    public function store(Request $req) {
    	$cron = new CronTimer;

    	$cron->cron_timer = $req->input('cron_timer');

    	$cron->save();

    	return back();
    }

    public function update(Request $req, $id) {
    	$cron = CronTimer::find($id);

    	$cron->cron_timer = $req->input('cron_timer');

    	$cron->save();

    	return back();
    }
}
