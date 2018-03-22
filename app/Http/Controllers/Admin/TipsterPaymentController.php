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

class TipsterPaymentController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public static function index()
    {
        $package = null;
        $flag = false;
        
        if (Input::get('param') == 'blank' || !Input::get('param') ) {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
        } else {
            $data['param'] = Input::get('param');
            $data['value'] = Input::get('value');
            $flag = true;
        }
        $package = SlotList::where('id_slot_status', '6');

        $user = User::find(Auth::id());
        if ($user->id_office != null) {
            $office = OfficeList::find($user->id_office);
            $package = $package->where('id_origin_city', $office->id_area);
        }

        if ($flag == true) {
            $package = $package->where(Input::get('param'), Input::get('value'))
                                ->get();
        } else {
            
            $package = $package->paginate(10);
        }

        $data['packages'] = $package;

        return view('admin.tipsterpayments.index', $data);
   }

   public static function update($id) {
        $slot = SlotList::find($id);
        $slot->status_bayar = 1;
        $slot->id_slot_status = 7;
        $slot->save();

        return back();
   }

}