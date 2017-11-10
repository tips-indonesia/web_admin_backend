<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AirportCityScope;
use App\AirportList;
use App\CityList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AirportCityScopeAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create($airport)
    {
        //
        $data['airport'] = AirportList::find($airport);
        $data['cities'] = CityList::all();
        return view('admin.airportcityscopes.create', $data);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store($airport)
    {
        //
        $rules = array(
            'city'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('airportcityscopes.create', $airport))
                ->withErrors($validator)
                ->withInput();
        } else {
            $airportcityScope = new AirportCityScope;
            $airportcityScope->id_city = Input::get('city');
            $airportcityScope->id_airport = $airport;
            $airportcityScope->status = 1;
            $airportcityScope->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('airportlists.show', $airport));
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
    public function edit($airport, $id)
    {
        //
        $airportcityScope = AirportCityScope::find($id);
        $data['datas'] =  $airportcityScope;
        $data['cities'] = CityList::all();
        return view('admin.airportcityscopes.edit', $data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($airport, $id)
    {
        //
        $rules = array(
            'city'       => 'required',
            'status'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('airportcityscopes.edit', [$airport, $id]))
                ->withErrors($validator)
                ->withInput();
        } else {
            $airportcityScope = AirportCityScope::find($id);
            $airportcityScope->id_city = Input::get('city');
            $airportcityScope->status = Input::get('status');
            $airportcityScope->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('airportlists.show', $airport));
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($airport,$id)
    {
        //
        $airportcityScope = AirportCityScope::find($id);
        $airportcityScope->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('airportlists.show', $airport));
    }
}
