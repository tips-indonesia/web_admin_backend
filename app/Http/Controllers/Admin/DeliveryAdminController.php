<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\DeliveryShipment;
use App\DeliveryShipmentDetail;
use App\ShipmentHistory;
use Validator;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DeliveryAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = DeliveryShipment::paginate(10);
        foreach ($data['datas'] as $dat) {
            $dat['total'] = DeliveryShipmentDetail::where('id_delivery', $dat->id)->get()->count();
        }
        return view('admin.deliveries.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        $date = Input::get('date');
        $data['date'] = null;
        if ($date == null) {
            $data['datas'] = array(); 
        } else {
            $data['datas'] = Shipment::where([['transaction_date', '=', $date], ['is_posted', '=', 1], ['id_shipment_status', '=', 2]])->get();
            $data['date'] = $date;
        }
        return view('admin.deliveries.create', $data);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {
        //
        $delivery = new DeliveryShipment;
        $delivery->delivery_date = Input::get('date');
        $delivery->delivery_time = Carbon::now()->hour.':'.Carbon::now()->minute;
        $delivery->created_by = Auth::user()->id; 
        $delivery->save();
        $delivery->delivery_id='DEL'.$delivery->id.'2017';
        $delivery->save();
        foreach(Input::get('shipments') as $shipment) {
            $deliv_details = new DeliveryShipmentDetail;
            $deliv_details->id_shipment = $shipment;
            $deliv_details->id_delivery = $delivery->id;
            $deliv_details->save();
        }
        return Redirect::to(route('deliveries.index'));



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
        $delivery_shipment_info = DeliveryShipment::find($id);
        $delivery_shipments = DeliveryShipmentDetail::where([['id_delivery', '=', $id]])->pluck('id_shipment')->toArray();
        $temp_shipments = Shipment::where([['transaction_date', '=', $delivery_shipment_info->delivery_date], ['is_posted', '=', 1], ['id_shipment_status', '=', 2]])->get();
        $data['delivery_shipments'] = $delivery_shipments;
        $data['shipment_lists'] = $temp_shipments;
        $data['data'] = $delivery_shipment_info;
        return view('admin.deliveries.edit', $data);

    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        $delivery = DeliveryShipment::find($id);
        if (Input::get('submit') =='post') {
            $delivery->is_posted = 1;
            $delivery->save();
            foreach(Input::get('shipments') as $shipment){
                $shipment_data = Shipment::find($shipment);
                $shipment_data->id_shipment_status = 3;
                $shipment_data->save();
                $shipment_history = new ShipmentHistory;
                $shipment_history->id_shipment = $shipment_data->id;
                $shipment_history->id_shipment_status = 3;
                $shipment_history->save();
            }
        }
        $delivdetails = DeliveryShipmentDetail::where('id_delivery', $id)->delete();
        if (Input::get('shipments') != null){
            foreach(Input::get('shipments') as $shipment){
                $deliv_details = new DeliveryShipmentDetail;
                $deliv_details->id_shipment = $shipment;
                $deliv_details->id_delivery = $delivery->id;
                $deliv_details->save();
            }
        }
        return Redirect::to(route('deliveries.index'));
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
    }
}
