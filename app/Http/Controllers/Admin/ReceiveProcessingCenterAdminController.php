<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DeliveryDeparture;
use App\PackagingDelivery;
use App\PackagingList;
use App\PackagingListStatus;
use App\PackagingListHistory;
use App\AirportcityList;
use App\SlotList;
use Auth;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ReceiveProcessingCenterAdminController extends Controller
{
    public function index()
    {
        if (Input::get('date')) {
            $deliveries = DeliveryDeparture::whereDate('delivery_date', Input::get('date'));
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
            $deliveries = DeliveryDeparture::whereDate('delivery_date', $data['date']);
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
        $shipments = PackagingDelivery::whereIn('deliveries_id', $deliveries)->pluck('packaging_id')->toArray();
        if (Input::get('param') == 'received') {
            $shipment_data = PackagingList::where('is_receive', true)->whereIn('id', $shipments);
        } else if (Input::get('param') == 'not_received') {
            $shipment_data = PackagingList::where('is_receive', false)whereIn('id', $shipments);
        } else {
            $shipment_data = PackagingList::where('id','!=', 0);
        }

        if ($flag == true) {
            $shipment_data = $shipment_data->where('packaging_id', $data['value'])->paginate(10);
        } else {
            $shipment_data = $shipment_data->paginate(10);
        }
        foreach($shipment_data as $ship) {
            if ($ship->id_slot != null) {
                $slot = SlotList::find($ship->id_slot);
                $ship['origin'] = AirportcityList::find($slot->id_origin_city)->name;
                $ship['destination'] = AirportcityList::find($slot->id_destination_city)->name;    
            }
            
        }
        $data['datas'] = $shipment_data;
        return view('admin.receiveprocessingcenters.index', $data);
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
        $shipments = PackagingDelivery::where('packaging_id', $id)->get()->first();
        $shipments->save();
        $process = PackagingList::find($id);
        $process->is_receive = true;
        $process->save();
        return Redirect::to(route('receiveprocessingcenters.index'));
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
