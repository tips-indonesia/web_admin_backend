<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\DeliveryShipment;
use App\DeliveryShipmentDetail;
use App\ShipmentHistory;
use App\AirportcityList;
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
        if (Input::get('date')) {
            $data['datas'] = DeliveryShipment::where('delivery_date', Input::get('date'));
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
            $data['datas'] = DeliveryShipment::where('delivery_date', $data['date']);
        }
        if (Input::get('param') == 'blank' || !Input::get('param') ) {
            $data['datas'] = $data['datas']->where('id', '!=', null);
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
        } else {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
            $data['datas'] = $data['datas']->where(Input::get('param'),'=', Input::get('value'));
        }
        $data['datas'] = $data['datas']->paginate(10);
        foreach ($data['datas'] as $dat) {
            $dat['total'] = DeliveryShipmentDetail::where('id_delivery', $dat->id)->get()->count();
        }
        $data['datas2'] = Shipment::where('id_shipment_status', 2)->whereIn('is_take', [0,2])->get();
        foreach ($data['datas2'] as $dat) {
            $dat['total'] = DeliveryShipmentDetail::where('id_delivery', $dat->id)->get()->count();
            $dat['origin'] = AirportcityList::find($dat->id_origin_city)->name;
            $dat['destination'] = AirportcityList::find($dat->id_destination_city)->name;
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
            $delship = DeliveryShipmentDetail::all()->pluck('id_shipment')->toArray();
            $data['datas'] = Shipment::where([['transaction_date', '=', $date], ['is_posted', '=', 1]])->whereIn('id_shipment_status', [0,2])->whereNotIn('id', $delship)->get();
            foreach ($data['datas'] as $dat) {
                $dat['origin_name'] = AirportcityList::find($dat->id_origin_city)->name;
                $dat['destination_name'] = AirportcityList::find($dat->id_destination_city)->name;
            }
            $data['date'] = $date;
        }
        return view('admin.deliveries.create', $data);
    }

    /**
    * Store a newly created resource in storage.
    *
-    * @return Response
    */
    public function store()
    {
        //
        $delivery = new DeliveryShipment;
        $delivery->delivery_date = Input::get('date');
        $delivery->delivery_time = Input::get('delivery_time');
        $delivery->created_by = Auth::user()->id; 
        $delivery->save();
        $delivery->delivery_id='DD'.date('ymd').str_pad($delivery->id, 4, '0', STR_PAD_LEFT);
        $delivery->save();
        if (Input::get('shipments') != null){
            foreach(Input::get('shipments') as $shipment) {
                $deliv_details = new DeliveryShipmentDetail;
                $deliv_details->id_shipment = $shipment;
                $deliv_details->id_delivery = $delivery->id;
                $deliv_details->save();
            }
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
        $delship = DeliveryShipmentDetail::where('id_delivery', '!=', $id)->pluck('id_shipment')->toArray();
        $delivery_shipment_info = DeliveryShipment::find($id);
        $delivery_shipments = DeliveryShipmentDetail::where([['id_delivery', '=', $id]])->pluck('id_shipment')->toArray();
        $temp_shipments = Shipment::where([['transaction_date', '=', $delivery_shipment_info->delivery_date], ['is_posted', '=', 1]])->whereNotIn('id', $delship)->whereIn('is_take', [0,2])->get();
        foreach ($temp_shipments as $dat) {
            $dat['origin_name'] = AirportcityList::find($dat->id_origin_city)->name;
            $dat['destination_name'] = AirportcityList::find($dat->id_destination_city)->name;
        }
        $data['delivery_shipments'] = $delivery_shipments;
        $data['shipment_lists'] = $temp_shipments;
        $data['data'] = $delivery_shipment_info;
        if ($delivery_shipment_info->is_posted == 0){
            return view('admin.deliveries.edit', $data);
        } else {
            return view('admin.deliveries.show', $data);
        }

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

        $delivery->delivery_time = Input::get('delivery_time');
        $delivery->save();
        if (Input::get('submit') =='post') {
            $delivery->is_posted = 1;
            $delivery->save();

        }
        $delivdetails = DeliveryShipmentDetail::where('id_delivery', $id)->delete();
        if (Input::get('shipments') != null){
            foreach(Input::get('shipments') as $shipment){
                $deliv_details = new DeliveryShipmentDetail;
                $deliv_details->id_shipment = $shipment;
                $deliv_details->id_delivery = $delivery->id;
                if (Input::get('submit') =='post') {
                    $ship = Shipment::find($shipment);
                    $ship->id_shipment_status = 3;
                    $ship->save();
                }
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
