<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AirportcityList;
use App\CountryList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AirportcityListAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = AirportcityList::paginate(10);
        return view('admin.airportcitylists.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        return view('admin.airportcitylists.create');
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
            'initial'    => 'required|max:4'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('airportcitylists.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $airportcityList = new AirportcityList;
            $airportcityList->name = Input::get('name');
            $airportcityList->initial_code = strtoupper(Input::get('initial'));
            $airportcityList->save();
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('airportcitylists.index'));
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
        $airportcityList = AirportcityList::find($id);
        $data['datas'] =  $airportcityList;
        return view('admin.airportcitylists.edit', $data);
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
            'initial'    => 'required|max:4'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('airportcitylists.edit', $id))
                ->withErrors($validator)
                ->withInput();
        } else {
            $airportcityList = AirportcityList::find($id); 
            $airportcityList->name = Input::get('name');
            $airportcityList->initial_code = strtoupper(Input::get('initial'));
            $airportcityList->save();
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('airportcitylists.index'));
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
        $airportcityList = AirportcityList::find($id);
        try {
            $airportcityList->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                // report($e);
                return back()->withErrors("Can't delete data because violating database integrity constraint");
            }
        }
        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('airportcitylists.index'));
    }
}
