<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OfficeType;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OfficeTypeAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = OfficeType::paginate(10);
        return view('admin.officetypes.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        // return view('admin.officetypes.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {
        //
        // $rules = array(
        //     'name'       => 'required',
        // );
        // $validator = Validator::make(Input::all(), $rules);

        // // process the login
        // if ($validator->fails()) {
        //     return Redirect::to(route('officetypes.create'))
        //         ->withErrors($validator)
        //         ->withInput();
        // } else {
        //     $officeTypes = new OfficeType;
        //     $officeTypes->name = Input::get('name');
        //     $officeTypes->save();
        //     Session::flash('message', 'Successfully created nerd!');
        //     return Redirect::to(route('officetypes.index'));
        // }

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
        // $officeTypes = OfficeType::find($id);
        // $data['datas'] =  $officeTypes;
        // return view('admin.officetypes.edit', $data);
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
        // $rules = array(
        //     'name'       => 'required',
        // );
        // $validator = Validator::make(Input::all(), $rules);

        // // process the login
        // if ($validator->fails()) {
        //     return Redirect::to(route('officetypes.edit'))
        //         ->withErrors($validator)
        //         ->withInput();
        // } else {
        //     $officeTypes = OfficeType::find($id);
        //     $officeTypes->name = Input::get('name');
        //     $officeTypes->save();
        //     Session::flash('message', 'Successfully created nerd!');
        //     return Redirect::to(route('officetypes.index'));
        // }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        // //
        // $officeTypes = OfficeType::find($id);
        // $officeTypes->delete();

        // // redirect
        // Session::flash('message', 'Successfully deleted the nerd!');
        // return Redirect::to(route('officetypes.index'));
    }
}
