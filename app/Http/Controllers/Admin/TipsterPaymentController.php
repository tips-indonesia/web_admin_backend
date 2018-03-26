<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\DeliveryDeparture;
use App\DeliveryDepartureDetail;
use App\ShipmentHistory;
use App\OfficeList;
use App\PackagingList;
use App\PackagingDelivery;
use App\Delivery;
use Validator;
use App\CityList;
use App\AirportcityList;
use App\AirportList;
use App\SlotList;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\User;
use App\MemberList;

class TipsterPaymentController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public static function index()
    {
        $flag = false;
        $flagdate = false;
        $package = SlotList::where('id_slot_status', '>=', '6');
        if (Input::get('date')) {
            $flagdate = true;
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
        }


        if (!isset($_GET['radio']))
            $checked = -1;
        else 
            $checked = Input::get('radio');


        if (Input::get('param') == 'blank' || !Input::get('param') ) {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
        } else {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
            $flag = true;
        }

        $user = User::find(Auth::id());
        if ($user->id_office != null) {
            $office = OfficeList::find($user->id_office);
            $package = $package->where('id_destination_city', $office->id_area);
        }

        if ($flag == true) {
            if (Input::get('param') == 'name') {
                $name = Input::get('value').'%';
                $package = $package->where('first_name', 'like', $name)->get();
            } else {
                $package = $package->where(Input::get('param'), Input::get('value'))
                                   ->get();
            }       
        } else {
            $package = $package->paginate(10);
        }

        
        foreach ($package as $pack) {
            $pack['is_included'] = true;
            if ($flagdate) {
                if (explode(' ', $pack->depature)[0] != $data['date']) {
                    $pack['is_included'] = false;
                }
            }
        }
        
        $data['packages'] = $package;
        $data['checked'] = $checked;
        return view('admin.tipsterpayments.index', $data);
   }

   public static function update($id) {
        $slot = SlotList::find($id);
        $slot->status_bayar = 1;
        $slot->id_slot_status = 7;
        $slot->save();

        
        $ms_user = MemberList::find($slot->id_member);
        $mess = 'Barang antaran telah diterima dan dalam proses verifikasi.';
        $firebase_sent = "";
        if($ms_user){
            if($ms_user->token) {
                FCMSender::post(array(
                    'type' => 'Delivery',
                    'id' => $slot->slot_id,
                    'status' => "6",
                    'message' => $mess,
                    'detail' => ""
                ), $ms_user->token);
                $firebase_sent = \Carbon\Carbon::now()->toDateTimeString();
            }else{
                $firebase_sent = "only user, no token";
            }
        }else{
            $firebase_sent = "no user: " . $slot->slot_id;
        }


        return back();
   }

}