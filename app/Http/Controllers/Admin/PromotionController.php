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

class PromotionController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index() {
    	return view('admin.promotions.index');
    }

    public function create() {
    	return view('admin.promotions.create');
    }

    public function store() {
        
    }
}
