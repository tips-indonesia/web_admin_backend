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
use App\DualLanguage;
use App\NotificationText;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\User;
use App\MemberList;
use App\Http\Controllers\FCMSender;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\BirdSenderController;
use App\Http\Controllers\cURLFaker;

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
        $package = SlotList::where('id_slot_status', '>=', '6');
        if (Input::get('date')) {
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
        if ($user->id_office != null  && $user->id != 1) {
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
            $package = $package->get();
        }

        
        foreach ($package as $pack) {
            $pack['is_included'] = true;
                if (explode(' ', $pack->depature)[0] != $data['date']) {
                    $pack['is_included'] = false;
                }
        }
        
        $data['packages'] = $package;
        $data['checked'] = $checked;

        //dd($data);
        return view('admin.tipsterpayments.index', $data);
   }

   public static function update($id) {
        $slot = SlotList::find($id);
        $slot->status_bayar = 1;
        $slot->id_slot_status = 7;
        $slot->save();
        $lang = DualLanguage::getActiveLang($slot->id_member);
        $slot->create_transaction_bayar_cash();
        $slot->smsStep7();
        
        $ms_user = MemberList::find($slot->id_member);
        $mess = NotificationText::getByKey('notiftipster07', $lang, NotificationText::PUSH_COLUMN);
        //'Barang antaran telah diverifikasi, proses telah selesai.';
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
            MessageController::sendMessageToUser("TIPS", $ms_user, "Delivery Status", "6", $mess);
        }else{
            $firebase_sent = "no user: " . $slot->slot_id;
        }

        $bsc = new cURLFaker;
        $email = $ms_user->email;
        $nama = $ms_user->first_name . ' ' . $ms_user->last_name;
        $bsc->sendMailTipsterStep7($email, $nama);


        return back();
   }

}