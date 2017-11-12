<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\OfficeType;
use App\CityList;
use App\OfficeDropPoint;
use App\AirportList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ShipmentAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = Shipment::paginate(10);
        return view('admin.shipments.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        $data['officetypes'] = OfficeType::all();
        $data['offices'] = Shipment::where('id_office_type', OfficeType::where('name', 'Counter')->first()->id)->get();
        $data['cities'] = CityList::all();
        $data['airports'] = AirportList::all();
        $data['processing_center'] = OfficeType::where('name', 'Processing Center')->first();
        return view('admin.shipments.create', $data);
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
            'office_type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'phone_no' => 'required',
            'fax_no' => 'required',
            'email_address' => 'required',
            'airport' => 'required',
            'airport_counter' => 'required_if:office_type,'.OfficeType::where('name', 'Processing Center')->first()->id,
            'contact_person' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('shipments.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $officeLists = new Shipment;
            $officeLists->name = Input::get('name');
            $officeLists->id_office_type = Input::get('office_type');
            $officeLists->address = Input::get('address');
            $officeLists->id_city = Input::get('city');
            $officeLists->phone_no = Input::get('phone_no');
            $officeLists->fax_no = Input::get('fax_no');
            $officeLists->email_address = Input::get('email_address');
            $officeLists->contact_person_name = Input::get('contact_person');
            $officeLists->latitude = Input::get('latitude');
            $officeLists->longitude = Input::get('longitude');
            $officeLists->id_airport = Input::get('airport');
            $officeLists->id_office_counter = Input::get('airport_counter');
            $officeLists->status = 1;
            $officeLists->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('shipments.index'));
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
        $data['office'] = Shipment::find($id);
        if ($data['office']->id_office_type == OfficeType::where('name', 'Processing Center')->first()->id) {
            $data['datas'] = OfficeDropPoint::where('id_office', $id)->paginate(10);
            foreach ($data['datas'] as $dat) {
                $dat['name'] = Shipment::find($dat->id_drop_point)->name;
            }
            return view('admin.officedroppoints.index', $data);
        }
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
        $data['datas'] = $officeLists = Shipment::find($id);
        $data['officetypes'] = OfficeType::all();
        $data['offices'] = Shipment::where('id_office_type', OfficeType::where('name', 'Counter')->first()->id);
        $data['cities'] = CityList::all();
        $data['processing_center'] = OfficeType::where('name', 'Processing Center')->first();
        $data['airports'] = AirportList::all();
        return view('admin.shipments.edit', $data);
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
            'office_type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'phone_no' => 'required',
            'fax_no' => 'required',
            'email_address' => 'required',
            'airport' => 'required',
            'airport_counter' => 'required_if:office_type,'.OfficeType::where('name', 'Processing Center')->first()->id,
            'contact_person' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('shipments.edit', $id))
                ->withErrors($validator)
                ->withInput();
        } else {
            $officeLists = Shipment::find($id);
            $officeLists->name = Input::get('name');
            $officeLists->id_office_type = Input::get('office_type');
            $officeLists->address = Input::get('address');
            $officeLists->id_city = Input::get('city');
            $officeLists->id_airport = Input::get('airport');
            $officeLists->id_office_counter = Input::get('airport_counter');
            $officeLists->phone_no = Input::get('phone_no');
            $officeLists->fax_no = Input::get('fax_no');
            $officeLists->email_address = Input::get('email_address');
            $officeLists->contact_person_name = Input::get('contact_person');
            $officeLists->latitude = Input::get('latitude');
            $officeLists->longitude = Input::get('longitude');
            $officeLists->id_office_counter = Input::get('airport_counter');
            $officeLists->status = Input::get('status');
            $officeLists->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('shipments.index'));
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
        $officeLists = Shipment::find($id);
        $officeLists->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('shipments.index'));
    }
}
