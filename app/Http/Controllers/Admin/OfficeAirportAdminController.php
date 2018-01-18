<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OfficeAirport;
use App\OfficeList;
use App\OfficeType;
use App\AirportList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OfficeAirportAdminController extends Controller
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
    public function create($office)
    {
        //
        $data['office'] = OfficeList::find($office);
        $data['airport'] = AirportList::all();
        return view('admin.officeairports.create', $data);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store($office)
    {
        //
        $rules = array(
            'airport'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('officeairports.create', $office))
                ->withErrors($validator)
                ->withInput();
        } else {
            $officedropPoint = new OfficeAirport;
            $officedropPoint->id_airport = Input::get('airport');
            $officedropPoint->id_office = $office;
            $officedropPoint->status = 1;
            $officedropPoint->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('officeairports.show', $office));
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
        $data['office'] = OfficeList::find($id);
        if ($data['office']->id_office_type == 5) {
            $data['datas'] = OfficeAirport::where('id_office', $id)->paginate(10);
            foreach ($data['datas'] as $dat) {
                $dat['name'] = AirportList::find($dat->id_airport)->name;
            }
            return view('admin.officeairports.index', $data);
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($office, $id)
    {
        //
        $officedropPoint = OfficeAirport::find($id);
        $data['datas'] =  $officedropPoint;
        $data['airport'] = AirportList::all();
        return view('admin.officeairports.edit', $data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($office, $id)
    {
        //
        $rules = array(
            'airport'       => 'required',
            'status'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('officeairports.edit', [$office, $id]))
                ->withErrors($validator)
                ->withInput();
        } else {
            $officedropPoint = OfficeAirport::find($id);
            $officedropPoint->id_airport = Input::get('airport');
            $officedropPoint->status = Input::get('status');
            $officedropPoint->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('officeairports.show', $office));
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($office,$id)
    {
        //
        $officedropPoint = OfficeAirport::find($id);
        $officedropPoint->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('officeairports.show', $office));
    }
}
