<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DeliveryShipment;
use App\DeliveryShipmentDetail;
use App\Shipment;
use App\ShipmentStatus;
use Auth;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ReceivedAdminController extends Controller
{
	public function index()
    {
        $deliveries = DeliveryShipment::where('is_posted', 1)->pluck('id')->toArray();
        $shipments = DeliveryShipmentDetail::whereIn('id_delivery', $deliveries)->where([['processing_center_received_by','=',null]])->pluck('id_shipment')->toArray();
        $shipment_data = Shipment::whereIn('id', $shipments)->paginate(10);
        foreach($shipment_data as $ship) {
            $ship['status_name'] = ShipmentStatus::find($ship->id_shipment_status)->description;
        }
        $data['datas'] = $shipment_data;
        return view('admin.receiveds.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {

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
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        if (Input::get('checked') != null) {
            $shipments = DeliveryShipmentDetail::where('id_shipment', $id)->get()->first();
            $shipments->processing_center_received_by = Auth::user()->id;
            $shipments->processing_center_received_date = Carbon::now();
            $shipments->processing_center_received_time = Carbon::now();
            $shipments->save();
            $process = Shipment::find($id);
            $process->id_shipment_status = ShipmentStatus::where('description', 'Received')->get()->id;
            $process->save();
        }
        return Redirect::to(route('receiveds.index'));
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
    }
}
