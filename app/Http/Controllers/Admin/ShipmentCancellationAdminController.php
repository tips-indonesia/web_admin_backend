<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use App\Shipment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\AirportcityList;
use App\ShipmentStatus;
use App\User;

class ShipmentCancellationAdminController extends Controller
{
    public function index() {
    	if (Input::get('date')) {
            $shipments = Shipment::where('transaction_date', Input::get('date'));
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
            $shipments = Shipment::where('transaction_date', $data['date']);
        }
        $shipments = $shipments->whereIn('id_shipment_status', [0,1])->paginate(10);

        foreach($shipments as $dat) {
            $dat['name_origin'] = AirportcityList::find($dat->id_origin_city)->name;
            $dat['name_destination'] = AirportcityList::find($dat->id_destination_city)->name;
            $dat['status'] = ShipmentStatus::find($dat->id_shipment_status)->description;
            $dat['pickup_by_user'] = User::find($dat->pickup_by);
        }

        $data['datas'] = $shipments;

    	return view('admin.shipmentcancellation.index', $data);
    }
}
