<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Shipment;
use App\MemberList;
use App\OfficeList;
use App\AirportcityList;

class PrintPickedUpShipmentManifestAdminController extends Controller
{
    public function index() {
        // Setting date
        if (Input::get('date')) {
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
        }

        $data['param'] = Input::get('param');
        $data['value'] = Input::get('value');

        $workers = Shipment::selectRaw('pickup_by, count(pickup_by) as total_shipment')
                            ->where('pickup_date', $data['date'])
                            ->whereNotNull('pickup_by')
                            ->groupBy('pickup_by')
                            ->get();

        foreach ($workers as $worker) {
            $user = MemberList::find($worker->pickup_by);
            $name = $user->first_name . " " . $user->last_name;
            if ($data['param'] == 'pickup_by') {
                $worker['is_included'] = strpos(" ".$name, $data['value']);
            } else {
                $worker['is_included'] = true;
            }
            $worker['name'] = $name;
            $worker['office_name'] = OfficeList::find($user->id_office)->name;
        }
        
        $data['datas'] = $workers;
        return view('admin.printpickedupshipmentmanifest.index', $data);
    }

    public function show($id) {
        if (isset($_GET['date'])) {
            $data['date'] = $_GET['date'];
            $user = MemberList::find($id);
            $data['worker_name'] = $user->first_name . " " . $user->last_name;
            $data['office_name'] = OfficeList::find($user->id_office)->name;

            $shipments = Shipment::where('pickup_by', $id)->
                                   where('pickup_date', $data['date'])->
                                   get();
            
            foreach ($shipments as $shipment) {
                $shipment['origin'] = AirportcityList::find($shipment->id_origin_city)->name;
                $shipment['destination'] = AirportcityList::find($shipment->id_destination_city)->name;
            }
            $data['shipments'] = $shipments;
            return view('admin.printpickedupshipmentmanifest.show', $data);
        } else {
            return back();
        }
    }
}
