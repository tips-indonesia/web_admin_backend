<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OfficeList;
use Spatie\Permission\Models\Role;
use App\User;
use Validator; 
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AddWorkerAbilityController extends Controller
{
     public function index() {
     	if (isset($_GET['firstname'])) {
     		$data['firstname'] = $_GET['firstname'];
             $users = User::where('first_name', 'LIKE', '%'.$data['firstname'].'%')
                            ->where('sms_code', -1);
     	} else {
     		$users = User::where('sms_code', -1);
     	}
        $users = $users->paginate(10);
     	$data['users'] = $users;
    	return view('admin.addworkerability.index', $data);
    }

    public function edit($id) {
        $data['roles'] = Role::all();
        $user = User::find($id);
        $data['offices'] = OfficeList::all();
        $data['datas'] =  $user;

        return view('admin.addworkerability.edit', $data);
    }

    public function update($id) {
        $rules = array(
            'is_worker' => 'required',
            'status_member' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::find($id);

            $user->is_worker = Input::get('is_worker');
            $user->status_member = Input::get('status_member');
            $user->save();
            
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('addworkerability.index'));
        }	
    }
}
