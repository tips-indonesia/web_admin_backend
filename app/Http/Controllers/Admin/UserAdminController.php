<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
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
        $data['datas'] = User::paginate(10);
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
        return view('admin.users.create', $data);
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
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('users.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::create(['name' => Input::get('name'), 
            'username' => Input::get('username'), 
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
        $user = User::find($id);
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
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('users.edit'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::find($id);
            $user->name = Input::get('name');
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
