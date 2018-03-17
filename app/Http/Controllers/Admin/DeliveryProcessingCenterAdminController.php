<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\DeliveryShipment;
use App\ArrivalShipment;
use App\ArrivalShipmentDetail;
use App\DeliveryShipmentDetail;
use App\ShipmentHistory;
use App\OfficeList;
use App\PackagingList;
use App\PackagingDelivery;
use App\AirportList;
use Validator;
use App\CityList;
use App\SlotList;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DeliveryProcessingCenterAdminController extends Controller
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
            $data['datas'] = ArrivalShipment::where('delivery_date', Input::get('date'));
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
            $data['datas'] = ArrivalShipment::where('delivery_date', $data['date']);
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
            $dat['total'] = PackagingDelivery::where('deliveries_id', $dat->id)->get()->count();
        }
        $data['pending'] = SlotList::where('id_slot_status', 6)->with('airportOrigin', 'airportDestination')->get();
        $data['datas2'] = ArrivalShipment::whereIn('delivery_id', $data['pending'])->get();
        foreach ($data['datas2'] as $dat) {
            $dat['total'] = PackagingDelivery::where('deliveries_id', $dat->id)->get()->count();
            $dat['origin'] = OfficeList::find($dat->id_origin_office)->name;
            $dat['destination'] = OfficeList::find($dat->id_destination_office)->name;
        }
        return view('admin.deliveryprocessingcenters.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        $date = Input::get('date');
        $data['date'] = null;
        if ($date == null) {
            $data['datas'] = array(); 
        } else {
            // todo slotlist 6 that not package / deliver yet
            $data['datas'] = SlotList::where('id_slot_status', 6)->get();
            $data['date'] = $date;
        }
        return view('admin.deliveryprocessingcenters.create', $data);
    }

    /**
    * Store a newly created resource in storage.
    *
-    * @return Response
    */
    public function store()
    {
        // dd($_POST);
        $delivery = new ArrivalShipment;
        $delivery->delivery_date = Input::get('date');
        $delivery->delivery_time = Input::get('delivery_time');
        $delivery->created_by = Auth::user()->id; 
        $delivery->save();
        $delivery->delivery_id='CD'.date('ymd').str_pad($delivery->id, 4, '0', STR_PAD_LEFT);
        $delivery->save();
        foreach(Input::get('shipments') as $shipment) {
            $deliv_details = new ArrivalShipmentDetail;
            $deliv_details->packaging_lists_id = $shipment;
            $deliv_details->arrival_shipment_id = $delivery->id;
            $deliv_details->save();
        }

        return Redirect::to(route('deliveryprocessingcenters.edit', ['id' => $delivery->id]));
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
        $data['data'] = ArrivalShipment::find($id);
        if(!$data['data'])
            return Redirect::to(route('deliveryprocessingcenters.index'));

        $data['delivery_shipments'] = ArrivalShipmentDetail::where('arrival_shipment_id','=',$data['data']->id)
            ->pluck('packaging_lists_id')
            ->toArray();

        $data['inputed_shipment_lists'] = SlotList::where('id_slot_status','=','7')
            ->with('packagingList', 'airportDestination', 'airportOrigin')
            ->get();

        $data['shipment_lists'] = SlotList::where('id_slot_status','=','6')
            ->with('packagingList', 'airportDestination', 'airportOrigin')
            ->get();

        return view('admin.deliveryprocessingcenters.edit', $data);

    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        $delivery = ArrivalShipment::find($id);
        if(!$delivery)
            return Redirect::to(route('deliveryprocessingcenters.index'));


        // dd('');
        $delivery->delivery_time = Input::get('delivery_time');
        $delivery->save();
        if (Input::get('submit') =='post') {
            $delivery->is_posted = 1;
            $delivery->save();
            // SLOT
            foreach ($delivery->arrivalShipmentDetail as $slot) {
                // TODO : Ubah menjadi mengubah status packaging list is_arrival_received
                // $slot->packagingList->id_arrival_receive = 1;
                // $slot->packagingList->save();
                // SHIPMENT
                foreach ($slot->packagingList->slotList->shipments as $shipment) {
                    $shipment->id_shipment_status = 11;
                    $shipment->save();
                }
            }
        // SHIPMENT

            // foreach(Input::get('shipments') as $shipment){
            //     $shipment_data = Shipment::find($shipment);
            //     $shipment_data->id_shipment_status = 14;
            //     $shipment_data->save();
            //     $shipment_history = new ShipmentHistory;
            //     $shipment_history->id_shipment = $shipment_data->id;
            //     $shipment_history->id_shipment_status = 14;
            //     $shipment_history->save();
            // }
        }
        $delivdetails = ArrivalShipmentDetail::where('arrival_shipment_id', $id)->delete();
        if (Input::get('shipments') != null){
            foreach(Input::get('shipments') as $shipment){
                $deliv_details = new ArrivalShipmentDetail;
                $deliv_details->packaging_lists_id = $shipment;
                $deliv_details->arrival_shipment_id = $id;
                $deliv_details->save();
            }
        }
        return Redirect::to(route('deliveryprocessingcenters.index'));
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
        $cityList = DeliveryShipment::find($id);
        $cityList->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('deliveryprocessingcenters.index'));
    }
}
