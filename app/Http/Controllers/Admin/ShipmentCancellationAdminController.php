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
use App\OfficeList;
use App\ProvinceList;
use App\CityList;
use App\SubdistrictList;
use App\PaymentType;
use App\BankList;
use App\BankCardList;
use SimpleSoftwareIO\QrCode\QrCodeServiceProvider;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use URL;
use Validator;
use App\Wallets;
use DateTime;
use DateTimeZone;

class ShipmentCancellationAdminController extends Controller
{
    public function index() {
    	$shipments = Shipment::withTrashed();

    	if (Input::get('param') == 'blank' || !Input::get('param') ) {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
        } else {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
            $shipments = $shipments->where($data['param'], $data['value']);
            // $query_param = $data['param'];
            // $query_value = $data['value'];
            // if($query_value == 'pending'){
            //     $query_param = 'is_posted';
            //     $query_value = 0;
            // }
            // $data['datas'] = $data['datas']->where($query_param,'=', $query_value);
        }
    	if (Input::get('date')) {
            $shipments = $shipments->where('transaction_date', Input::get('date'));
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
            $shipments = $shipments->where('transaction_date', $data['date']);
        }

        $user = User::find(Auth::id());

        if ($user->id_office != null  && $user->id != 1) {
            $office = OfficeList::find($user->id_office);
            $shipments = $shipments->where('id_origin_city', $office->id_area);
        }

        $shipments = $shipments->whereIn('id_shipment_status', [0,1])->paginate(10);

        foreach($shipments as $dat) {
            $dat['name_origin'] = AirportcityList::find($dat->id_origin_city)->name;
            $dat['name_destination'] = AirportcityList::find($dat->id_destination_city)->name;
            $dat['pickup_by_user'] = User::find($dat->pickup_by);
        }

        $data['datas'] = $shipments;

    	return view('admin.shipmentcancellation.index', $data);
    }

    public function show($id) {
		if (Input::get('ajax') == 1) {
            return json_encode(Shipment::where('id_slot', $id)->get(['shipment_id', 'estimate_weight']));
        } else {
                    $data['data'] = Shipment::withTrashed()->find($id);
                    $shipment = Shipment::find($id);
        $data['provinces'] = ProvinceList::all();
        $data['citys'] = CityList::where('id_province', $data['data']->id_shipper_province)->get();
        $data['subdistricts'] = SubdistrictList::where('id_city', $data['data']->id_shipper_city)->get();
        $data['cities'] = AirportcityList::all();
        $data['shipment_statuses'] = ShipmentStatus::all();
        $data['users'] = User::all();
        $data['payment_types'] = PaymentType::all();
        $data['banklists'] = BankList::all();
        $data['bankcardlists'] = BankCardList::where('id_bank', $data['data']->id_bank)->get();

        $dataqr = base64_encode(QrCode::format('png')->size(300)->margin(0)->merge('/public/images/logoqr.png',.25)->encoding('UTF-8')->errorCorrection('H')->generate($data['data']->shipment_id));
        $qrcode = base64_decode($dataqr);
        Storage::disk('local')->put('images/qrcode/pickup/'.$data['data']->shipment_id.'.png',$qrcode, 'public');

        return view('admin.shipmentcancellation.show', $data);
        }    	
    }

    public function update($id) {
    	$rule = [
    		'additional_notes' => 'required',
    	];

    	$validate = Validator::make(['additional_notes' => Input::get('additional_notes')], $rule);

    	if ($validate->fails()) {
    		return Redirect::to(route('shipmentcancellation.show', $id))
                ->withErrors($validate)
                ->withInput();
    	} else {
	    	$shipment = Shipment::find($id);
	    	
            $wallets = Wallets::where('remarks', $shipment->shipment_id)->first();
            if ($wallets != null) {
                $wallets->delete();
            }

            $shipment->id_shipment_status = 0;
            $shipment->add_notes = Input::get('additional_notes');
            $date_deleted = new DateTime();
            $date_deleted->setTimezone(new DateTimeZone('Asia/Jakarta'));
            // $shipment->deleted_at = Carbon::now()->toDateTimeString();
            $shipment->deleted_at = $date_deleted->format('Y-m-d H:i:s');
	    	$shipment->save();

	    	return back();
	    }
    }
}
