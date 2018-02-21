<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\ShipmentStatus;
use App\User;
use App\MemberList;
use App\Insurance;
use App\PaymentType;
use App\BankList;
use App\BankCardList;
use App\CityList;
use App\ProvinceList;
use App\SubdistrictList;
use App\AirportcityList;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\QrCodeServiceProvider;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

use URL;

class ShipmentPickUpAdminController extends Controller
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
            $data['datas'] = Shipment::where('transaction_date', Input::get('date'));
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
            $data['datas'] = Shipment::where('transaction_date', $data['date']);
        }
        if (Input::get('param') == 'blank' || !Input::get('param') ) {
            $data['datas'] = $data['datas']->where('id', '!=', null);
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
        } else {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
            
            $query_param = $data['param'];
            $query_value = $data['value'];
            if($query_param == 'pending'){
                $query_param = 'is_posted';
                $query_value = 0;
            }
            $data['datas'] = $data['datas']->where($query_param,'=', $query_value);
        }
        $data['datas'] = $data['datas']->where('is_take',1)->paginate(10);
        foreach($data['datas'] as $dat) {
            $dat['name_origin'] = AirportcityList::find($dat->id_origin_city)->name;
            $dat['name_destination'] = AirportcityList::find($dat->id_destination_city)->name;
            $dat['status'] = ShipmentStatus::find($dat->id_shipment_status)->description;
            $dat['pickup_by_user'] = User::find($dat->pickup_by);
        }
        return view('admin.shipmentpickups.index', $data);
    }

    // public function base64_to_png($base64_string, $output_file) {
    //     $ifp = fopen( $output_file, 'wb' ); 
    //     $data = explode( ',', $base64_string );

    //     // we could add validation here with ensuring count( $data ) > 1
    //     fwrite( $ifp, base64_decode( $base64_string) );

    //     // clean up the file resource
    //     fclose( $ifp ); 

    //     return $output_file; 
    // }

    public function show($id)
    {
        if (Input::get('ajax') == 1) {
            return json_encode(Shipment::where('id_slot', $id)->get(['shipment_id', 'estimate_weight']));
        } else {
                    $data['data'] = Shipment::find($id);
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

        $dataqr = base64_encode(QrCode::format('png')->size(300)->margin(0)->merge('public/images/logoqr.png',.25)->encoding('UTF-8')->errorCorrection('H')->generate($data['data']->shipment_id));
        $qrcode = base64_decode($dataqr);
        Storage::disk('local')->put('images/qrcode/pickup/'.$data['data']->shipment_id.'.png',$qrcode, 'public');

        return view('admin.shipmentpickups.show', $data);
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data['data'] = Shipment::find($id);
        if ($data['data']->is_posted == 1) {
            return Redirect::to(route('shipmentpickups.show', $id));
        }
        $data['provinces'] = ProvinceList::all();
        $data['citys'] = CityList::where('id_province', $data['data']->id_shipper_province)->get();
        $data['subdistricts'] = SubdistrictList::where('id_city', $data['data']->id_shipper_city)->get();
        $data['cities'] = AirportcityList::all();
        $data['shipment_statuses'] = ShipmentStatus::all();
        $data['users'] = User::all();
        $data['payment_types'] = PaymentType::all();
        $data['banklists'] = BankList::all();
        $data['bankcardlists'] = BankCardList::where('id_bank', $data['data']->id_bank)->get();

        $dataqr = base64_encode(QrCode::format('png')
                            ->size(300)
                            ->margin(0)
                            ->merge('/public/images/logoqr.png',.4)
                            ->encoding('UTF-8')
                            ->errorCorrection('H')
                            ->generate($data['data']->shipment_id));
        $qrcode = base64_decode($dataqr);
        Storage::disk('local')->put('images/qrcode/pickup/'.$data['data']->shipment_id.'.png',$qrcode, 'public');
        
        return view('admin.shipmentpickups.edit', $data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        $rules = array (
            'pickup_by' => 'required',
            'pickup_date' => 'required',
            'pickup_time' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to(route('shipmentpickups.edit', $id))
                ->withErrors($validator)
                ->withInput();
        } else {
            $shipment = Shipment::find($id);
            $shipment->pickup_date = Input::get('pickup_date');
            $shipment->pickup_time = Input::get('pickup_time');
            $shipment->pickup_by = Input::get('pickup_by');
            $shipment->save();

            if (Input::get('submit') == 'post') {
                $shipment->is_posted = true;
                $shipment->save();
            }
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('shipmentpickups.index'));
        }
    }

    public function qrcode($id)
    {
        $shipment = Shipment::find($id);
        $data = array(
            'err' => null,
            'result' => 'storage/app/images/qrcode/pickup/'.$shipment->shipment_id.'.png'
        );
        return json_encode($data,JSON_UNESCAPED_SLASHES);
    }

    public function createQR(Request $req){
        $dataqr = base64_encode(
                QrCode::format('png')->size(300)
                                     ->margin(0)
                                     ->merge('/public/images/logoqr.png',.4)
                                     ->encoding('UTF-8')
                                     ->errorCorrection('H')
                                     ->generate($req->data));
        $qrcode = base64_decode($dataqr);
        // file_put_contents('tmp/image.png, $qrcode);
        $url = 'images/qrcode/pickup/QR-' . uniqid() . '-GX.png';
        Storage::disk('public')->put($url, $qrcode, 'public');

        return URL::to('storage/' . $url);
    }
}
