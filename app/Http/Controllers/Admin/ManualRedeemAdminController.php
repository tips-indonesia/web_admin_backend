<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\MemberList;

class ManualRedeemAdminController extends Controller
{
    public function index() {
        if (Input::get('date')) {
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
        }

        return view('admin.manualredeem.index', $data);
    }

    public function create() {
        $data['date'] = $_GET['date'];

        return view('admin.manualredeem.create', $data);
    }

    public function getMemberList(Request $request) {
        $members = MemberList::select('first_name', 'last_name', 'mobile_phone_no', 'address');
        if ($request->get('query')) {
            $members = $members->where('first_name', 'LIKE', $request->get('query'));
        }
        $members = $members->get();

        return response($members, 200);
    }
}
