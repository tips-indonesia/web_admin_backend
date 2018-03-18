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


        $tahun = DB::table('year_period')->get();
        $bulan = DB::table('month_period')->get();

        return view('admin.promotions.index')->with('tahun',$tahun)
                                             ->with('bulan',$bulan);
    }

    public function show($year) {
        \Log::info('asdasd');
        if(Input::get('bulan') === 'Januari') {
            $month = '01';
        }elseif(Input::get('bulan') === 'Februari') {
            $month = '02';
        }elseif(Input::get('bulan') === 'Maret') {
            $month = '03';
        }elseif(Input::get('bulan') === 'April') {
            $month = '04';
        }elseif(Input::get('bulan') === 'Mei') {
            $month = '05';
        }elseif(Input::get('bulan') === 'Juni') {
            $month = '06';
        }elseif(Input::get('bulan') === 'Juli') {
            $month = '07';
        }elseif(Input::get('bulan') === 'Agustus') {
            $month = '08';
        }elseif(Input::get('bulan') === 'September') {
            $month = '09';
        }elseif(Input::get('bulan') === 'Oktober') {
            $month = '10';
        }elseif(Input::get('bulan') === 'November') {
            $month = '11';
        }else {
            $month = '12';
        }
        $date = Input::get('tanggal');
        $date = $year.'/'.$month.'/'.$date;

        $data = DB::table('promotions')->where('start_date','<=',$date)->where('end_date','>=',$date)->get();
        \Log::info($data);
    	return view('admin.promotions.show')->with('data',$data);
    }

    public function create() {
    	return view('admin.promotions.create');
    }

    public function store(Request $request) {
        $filename;
        if($request->hasFile('image')) {
                $avatar = $request->file('image');
                $filename = uniqid(). '.'. $avatar->getClientOriginalExtension();
                $avatar->storeAs('public/promotions',$filename);
        }
        \Log::info($filename);
        DB::table('promotions')->insert(
            ['start_date' => Input::post('tanggal_awal'), 'end_date' => Input::post('tanggal_akhir'), 'header' => Input::post('header_text'),'template_type' => Input::post('template'), 'discount_value' => Input::post('discount'), 'file_name' => $filename]
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
