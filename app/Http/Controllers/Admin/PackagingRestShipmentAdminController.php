<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PackagingList;
use App\CityList;
use App\Shipment;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PackagingRestShipmentAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = PackagingList::paginate(10);
        foreach ($data['datas'] as $dat) {
            $dat['count'] = count(Shipment::where('id_packaging', $dat->id)->get());
        }
        return view('admin.packagingrestshipments.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        $data['shipment'] = Shipment::where('id_packaging', null)->where('is_posted', 1)->get();
        return view('admin.packagingrestshipments.create', $data);
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
            'shipment'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('packagingrestshipments.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $airportList = new PackagingList;
            $airportList->packaging_id = 'x';
            $airportList->save();
            $airportList->packaging_id = $airportList->id.'2017'; 
            $airportList->save();
            $shipments = Input::get('shipment');
            foreach ($shipments as $shipment) {
                $shipment_item = Shipment::find($shipment);
                $shipment_item->id_packaging = $airportList->id;
                $shipment_item->save();
            }
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('packagingrestshipments.index'));
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
        // $data['airport'] = PackagingList::find($id);
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
        $data['data'] = PackagingList::find($id);
        $data['shipment'] = Shipment::where('id_packaging', $id)->where('is_posted', 1)->get();
        $data['shipment_not'] = Shipment::where('id_packaging', null)->where('is_posted', 1)->get();
        return view('admin.packagingrestshipments.edit', $data);
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
            'shipment'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('packagingrestshipments.edit', $id))
                ->withErrors($validator)
                ->withInput();
        } else {
            $airportList = PackagingList::find($id);
            $shipments = Shipment::where('id_packaging', $id)->get();
            foreach ($shipments as $shipment) {
                $shipment->id_packaging = null;
                $shipment->save();
            }
            $shipments = Input::get('shipment');
            foreach ($shipments as $shipment) {
                $shipment_item = Shipment::find($shipment);
                $shipment_item->id_packaging = $id;
                $shipment_item->save();
            }
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('packagingrestshipments.index'));
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
        $airportList = PackagingList::find($id);
        $airportList->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('packagingrestshipments.index'));
    }
}
