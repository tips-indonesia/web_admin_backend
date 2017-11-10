<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PermissionAdminController extends Controller
{
	/**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {

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
    	$permissions = Permission::all();
    	$role = Role::find($id);
    	$data['set'] = array();
    	$data['unset'] = array();
    	$data['role'] = $role;
    	foreach ($permissions as $permission) {
    		if ($role->hasPermissionTo($permission->name)) {
    			array_push($data['set'], $permission);
    		} else {
    			array_push($data['unset'], $permission);
    		}
    	}
    	return view('admin.permissions.edit', $data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
    	$rules = array(
            'permission'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('roles.show', $id))
                ->withErrors($validator)
                ->withInput();
        } else {
    		$permissions = Input::get('permission');
            $role = Role::find($id);
            $arr_permissions = Permission::whereIn('id', $permissions)->get();
            $role->syncPermissions($arr_permissions);
            return Redirect::to(route('roles.show', $id));
        }
    	return;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
    }
}