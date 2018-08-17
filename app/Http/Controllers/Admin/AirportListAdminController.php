<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AirportList;
use App\AirportcityList;
use App\AirportCityScope;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AirportListAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = AirportList::paginate(10);
        return view('admin.airportlists.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        $data['cities'] = AirportcityList::all();
        return view('admin.airportlists.create', $data);
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
            'initial_code'       => 'required',
            'city' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('airportlists.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $airportList = new AirportList;
            $airportList->name = Input::get('name');
            $airportList->initial_code = Input::get('initial_code');
            $airportList->id_city = Input::get('city');
            $airportList->status = 1;
            $airportList->save();
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('airportlists.index'));
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
        // $data['airport'] = AirportList::find($id);
        // $data['datas'] = AirportCityScope::where('id_airport', $id)->paginate(10);
        // foreach ($data['datas'] as $dat) {
        //     $dat['name'] = CityList::find($dat->id_city)->name;
        // }
        
        // return view('admin.airportcityscopes.index', $data);
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
        $airportList = AirportList::find($id);
        $data['cities'] = AirportcityList::all();
        $data['datas'] =  $airportList;
        return view('admin.airportlists.edit', $data);
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
            'initial_code'       => 'required',
            'city'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('airportlists.edit'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $airportList = AirportList::find($id);
            $airportList->name = Input::get('name');
            $airportList->initial_code = Input::get('initial_code');
            $airportList->id_city = Input::get('city');
            $airportList->status = Input::get('status');;
            $airportList->save();
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('airportlists.index'));
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
        $airportList = AirportList::find($id);
        $airportList->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('airportlists.index'));
    }
}
