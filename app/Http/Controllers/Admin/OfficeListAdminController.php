<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OfficeList;
use App\OfficeType;
use App\ProvinceList;
use App\OfficeDropPoint;
use App\AirportList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OfficeListAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = OfficeList::paginate(10);
        foreach ($data['datas'] as $dat) {
            $dat['office_type_name'] = OfficeType::find($dat->id_office_type)->name;
        }
        $data['processing_center'] = OfficeType::where('name', 'Processing Center')->first();
        
        return view('admin.officelists.index', $data);
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
        $data['pcs'] = OfficeList::where('id_office_type', 3)->get();

        $data['acs'] = OfficeList::where('id_office_type', 2)->get();
        $data['provinces'] = ProvinceList::all();
        $data['airports'] = AirportList::all();
        return view('admin.officelists.create', $data);
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
            'province' => 'required',
            'subdistrict' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'phone_no' => 'required',
            'fax_no' => 'required',
            'email_address' => 'required',
            'airport_counter' => 'required_if:office_type,5',
            'processing_center' => 'required_if:office_type,2|required_if:office_type,3',
            'contact_person' => 'required',
            'airport' => 'required_if:office_type,4'
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('officelists.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $officeLists = new OfficeList;
            $officeLists->name = Input::get('name');
            $officeLists->id_office_type = Input::get('office_type');
            $officeLists->address = Input::get('address');
            $officeLists->id_city = Input::get('city');
            $officeLists->id_province = Input::get('province');
            $officeLists->id_subdistrict = Input::get('subdistrict');
            $officeLists->phone_no = Input::get('phone_no');
            $officeLists->fax_no = Input::get('fax_no');
            $officeLists->email_address = Input::get('email_address');
            $officeLists->contact_person_name = Input::get('contact_person');
            $officeLists->latitude = Input::get('latitude');
            $officeLists->longitude = Input::get('longitude');
            if (Input::get('airport_counter'))
                $officeLists->id_office_counter = Input::get('airport_counter');
            if (Input::get('processing_center'))
                $officeLists->processing_center = Input::get('processing_center');
            if (Input::get('airport'))
                $officeLists->id_airport = Input::get('airport');
            $officeLists->status = 1;
            $officeLists->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('officelists.index'));
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
        $data['datas'] = $officeLists = OfficeList::find($id);
        $data['officetypes'] = OfficeType::all();
        $data['pcs'] = OfficeList::where('id_office_type', 3)->get();

        $data['acs'] = OfficeList::where('id_office_type', 4)->get();
        $data['provinces'] = ProvinceList::all();
        $data['processing_center'] = OfficeType::where('name', 'Processing Center')->first();
        $data['airports'] = AirportList::all();
        return view('admin.officelists.edit', $data);
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
            'city' => 'required',
            'province' => 'required',
            'subdistrict' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'phone_no' => 'required',
            'fax_no' => 'required',
            'email_address' => 'required',
            'airport_counter' => 'required_if:office_type,3',
            'processing_center' => 'required_if:office_type,4|required_if:office_type,5',
            'contact_person' => 'required',
            'airport' => 'required_if:office_type,2'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('officelists.edit', $id))
                ->withErrors($validator)
                ->withInput();
        } else {
            $officeLists = OfficeList::find($id);
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
            if (Input::get('airport_counter'))
                $officeLists->id_office_counter = Input::get('airport_counter');
            if (Input::get('processing_center'))
                $officeLists->processing_center = Input::get('processing_center');
            if (Input::get('airport'))
                $officeLists->id_airport = Input::get('airport');
            $officeLists->status = 1;
            $officeLists->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('officelists.index'));
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
        $officeLists = OfficeList::find($id);
        $officeLists->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('officelists.index'));
    }
}
