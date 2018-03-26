<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\OfficeList;
use Spatie\Permission\Models\Role;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = User::where('is_worker', 1)->paginate(10);
        return view('admin.users.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        $data['roles'] = Role::all();
        $data['offices'] = OfficeList::all();
        return view('admin.users.create', $data);
    }

    public function changePhoneNumber($phone) {
        if ($phone[0] == '0') {
            for ($i = 0; $i < strlen($phone)-1; $i++) {
                $phone[$i] = $phone[$i+1];
            }
        }
       return '+62'.$phone;
    }
    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {
        //
        $rules = array(
            'fname' => 'required',
            'lname' => 'required',
            'mobile_phone_no' => 'required',
            'email' => 'email',
            'birth_date' => 'required',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
            'office' => 'required'
        );

        $messages = array(
            'required' => 'this field is required', 
            'confirmed' => 'make sure password and confirm password matched',
            'min' => 'password length at least 6 chars' );
        $validator = Validator::make(Input::all(), $rules, $messages);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('users.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $phone = $this->changePhoneNumber(Input::get('mobile_phone_no'));
            
            $user = User::create([
            'first_name' => Input::get('fname'), 
            'last_name' => Input::get('lname'), 
            'mobile_phone_no' => $phone,
            'email' => Input::get('email'),
            'registered_date' => date('Y-m-d'),
            'birth_date' => Input::get('birth_date'),
            'is_worker' => Input::get('worker'),
            'id_office' => Input::get('office'),
            'password' => bcrypt(Input::get('password'))]);
            $role = Role::find(Input::get('role'));
            $user->assignRole($role->name);
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('users.index'));
        }

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        //
        $data['roles'] = Role::all();
        $user = User::find($id);
        $data['offices'] = OfficeList::all();
        $data['datas'] =  $user;
        return view('admin.users.edit', $data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        //
        $rules = array(
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'birth_date' => 'required',
            'role'  => 'required',
            'office' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('users.edit'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::find($id);
            $user->first_name = Input::get('fname');
            $user->last_name = Input::get('lname');
            $user->email = Input::get('email');
            $user->birth_date = Input::get('birth_date');
            $role = Role::find(Input::get('role'));
            $user->id_office = Input::get('office');
            $user->syncRoles($role);
            $user->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('users.index'));
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        $user->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('users.index'));
    }
}
