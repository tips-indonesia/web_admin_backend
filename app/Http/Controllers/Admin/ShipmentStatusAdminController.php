<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShipmentStatus;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ShipmentStatusAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = ShipmentStatus::paginate(10);
        return view('admin.shipmentstatuses.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        return view('admin.shipmentstatuses.create');
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
            'description'       => 'required',
            'step'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('shipmentstatuses.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $shipmentStatus = new ShipmentStatus;
            $shipmentStatus->step = Input::get('step');
            $shipmentStatus->description = Input::get('description');
            $shipmentStatus->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('shipmentstatuses.index'));
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
        $shipmentStatus = ShipmentStatus::find($id);
        $data['datas'] =  $shipmentStatus;
        return view('admin.shipmentstatuses.edit', $data);
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
            'description'       => 'required',
            'step'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('shipmentstatuses.edit'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $shipmentStatus = ShipmentStatus::find($id);
            $shipmentStatus->step = Input::get('step');
            $shipmentStatus->description = Input::get('description');
            $shipmentStatus->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('shipmentstatuses.index'));
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
        $shipmentStatus = ShipmentStatus::find($id);
        $shipmentStatus->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('shipmentstatuses.index'));
    }
}
