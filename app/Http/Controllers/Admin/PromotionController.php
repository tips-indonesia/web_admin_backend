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
use DB;

class PromotionController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index() {
        $data = DB::table('promotions')->get();
        \Log::info($data);
    	return view('admin.promotions.index')->with('data',$data);
    }

    public function create() {
    	return view('admin.promotions.create');
    }

    public function store(Request $request) {
        $filename;
        if($request->hasFile('image')) {
                $avatar = $request->file('image');
                $filename = Input::post('title'). '.'. $avatar->getClientOriginalExtension();
                $avatar->storeAs('public/promotions',$filename);
        }
        // \Log::info($filename);
        DB::table('promotions')->insert(
            ['title' => Input::post('title'), 'description' => Input::post('description'), 'filename' => $filename]
        );
        return redirect('admin/promotions');
    }

    public function destroy($id)
    {
        //
        DB::table('promotions')->where('id',$id)->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('promotions.index'));
    }
}
