<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DeliveryShipment;
use App\DeliveryShipmentDetail;
use App\Shipment;
use App\ShipmentStatus;
use App\ShipmentHistory;
use App\AirportcityList;
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
        if (Input::get('date')) {
            $deliveries = DeliveryShipment::whereDate('delivery_date', Input::get('date'))->where('is_posted', 1);
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
            $deliveries = DeliveryShipment::whereDate('delivery_date', $data['date'])->where('is_posted', 1);
        }
        $flag = false;
        if (Input::get('param') == 'blank' || !Input::get('param') || Input::get('param') == 'received' || Input::get('param') == 'not_received' ) {
            $deliveries = $deliveries->where('id', '!=', null)->where('is_posted', 1);
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
        } else {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
            $flag = true;
        }

        $deliveries = $deliveries->pluck('id')->toArray();
        $shipment_1 = DeliveryShipmentDetail::whereIn('id_delivery', $deliveries)->pluck('id_shipment')->toArray();
        $shipments_2 = Shipment::where('is_take',1)->where('is_posted', 1)->pluck('id')->toArray();
        $shipments = array_merge($shipment_1, $shipments_2);
        if (Input::get('param') == 'received') {
            $shipment_data = Shipment::where('id_shipment_status', 4)->whereIn('id', $shipments);
        } else if (Input::get('param') == 'not_received') {
            $shipment_data = Shipment::where('id_shipment_status', 3)->whereIn('id', $shipments);
        } else {
            $shipment_data = Shipment::where('id','!=', 0)->whereIn('id', $shipments);
        }
        if ($flag == true) {
            $shipment_data = $shipment_data->where('shipment_id', $data['value'])->paginate(10);
        } else {
            $shipment_data = $shipment_data->whereIn('id_shipment_status', [3,4])->paginate(10);
        }
        
        foreach($shipment_data as $ship) {
            $ship['origin'] = AirportcityList::find($ship->id_origin_city)->name;
            $ship['destination'] = AirportcityList::find($ship->id_destination_city)->name;
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
        $process = Shipment::find($id);
        $process->id_shipment_status = 4;
        $process->save();
        $shipment_history = new ShipmentHistory;
        $shipment_history->id_shipment_status = 4;
        $shipment_history->id_shipment = $id;
        $shipment_history->save();
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
