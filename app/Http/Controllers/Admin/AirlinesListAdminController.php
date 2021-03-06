<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AirlinesList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AirlinesListAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = AirlinesList::paginate(10);
        return view('admin.airlineslists.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        return view('admin.airlineslists.create');
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
            'name'       => 'required',
            'prefix_flight_code'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('airlineslists.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $airlinesList = new AirlinesList;
            $airlinesList->name = Input::get('name');
            $airlinesList->prefix_flight_code = Input::get('prefix_flight_code');
            $airlinesList->status = 1;
            $airlinesList->save();
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('airlineslists.index'));
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
        $airlinesList = AirlinesList::find($id);
        $data['datas'] =  $airlinesList;
        return view('admin.airlineslists.edit', $data);
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
            'prefix_flight_code'       => 'required',
            'status'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('airlineslists.edit'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $airlinesList = AirlinesList::find($id);
            $airlinesList->name = Input::get('name');
            $airlinesList->prefix_flight_code = Input::get('prefix_flight_code');
            $airlinesList->status = Input::get('status');
            $airlinesList->save();
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('airlineslists.index'));
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
        $airlinesList = AirlinesList::find($id);
        
        try {
            $airlinesList->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                // report($e);
                return back()->withErrors("Can't delete data because violating database integrity constraint");
            }
        }

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('airlineslists.index'));
    }
}
