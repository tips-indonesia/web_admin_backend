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


        if(Input::get('bulan') === 'January') {
            $month = '01';
        }elseif(Input::get('bulan') === 'February') {
            $month = '02';
        }elseif(Input::get('bulan') === 'March') {
            $month = '03';
        }elseif(Input::get('bulan') === 'April') {
            $month = '04';
        }elseif(Input::get('bulan') === 'May') {
            $month = '05';
        }elseif(Input::get('bulan') === 'June') {
            $month = '06';
        }elseif(Input::get('bulan') === 'July') {
            $month = '07';
        }elseif(Input::get('bulan') === 'August') {
            $month = '08';
        }elseif(Input::get('bulan') === 'September') {
            $month = '09';
        }elseif(Input::get('bulan') === 'October') {
            $month = '10';
        }elseif(Input::get('bulan') === 'November') {
            $month = '11';
        }else {
            $month = '12';
        }
        $year = Input::get('tahun');
       

        $data = DB::table('promotions')->whereMonth('start_date','<=',$month)->whereMonth('end_date','>=',$month)->whereYear('start_date',$year)->get();
        \Log::info($data);
       
        return view('admin.promotions.index')->with('tahun',$tahun)
                                             ->with('bulan',$bulan)
                                             ->with('data', $data)
                                             ->with('namabulan', Input::get('bulan'))
                                             ->with('namatahun', Input::get('tahun'));
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


        if(Input::post('tanggal_awal') > Input::post('tanggal_akhir')) {
            return redirect('admin/promotions')->with('status', 'Tanggal Akhir harus lebih besar dari Tanggal Awal');
        } else {
            DB::table('promotions')->insert(
                ['start_date' => Input::post('tanggal_awal'), 'end_date' => Input::post('tanggal_akhir'), 'header' => Input::post('header_text'), 'content' => Input::post('content_text'),'template_type' => Input::post('template'), 'discount_value' => Input::post('discount'), 'file_name' => $filename]
            );
            return redirect('admin/promotions/create');
        }


        
    }

    public function destroy($id)
    {
        //
        DB::table('promotions')->where('id',$id)->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('promotions.index'));
    }

    public function edit($id) {
        $data = DB::table('promotions')->where('id', $id)->first();
        return view('admin.promotions.edit')->with('data', $data);
    }

    public function update(Request $request, $id) {
        $filename;
        if($request->hasFile('image')) {
                $avatar = $request->file('image');
                $filename = uniqid(). '.'. $avatar->getClientOriginalExtension();
                $avatar->storeAs('public/promotions',$filename);

                if(Input::get('tanggal_awal') > Input::get('tanggal_akhir')) {
                    return redirect('admin/promotions/'.$id.'/edit?')->with('status', 'Tanggal Akhir harus lebih besar dari Tanggal Awal');
                } else {
                    DB::table('promotions')->where('id', $id)->update(['start_date' => Input::get('tanggal_awal'), 'end_date' => Input::get('tanggal_akhir'), 'content' => Input::get('content_text'),'template_type' => Input::get('template'), 'discount_value' => Input::get('discount'), 'file_name' => $filename]);
                    return Redirect::to(route('promotions.index'));
                }
                
        } else {
            if(Input::get('tanggal_awal') > Input::get('tanggal_akhir')) {
                    return redirect('admin/promotions/'.$id.'/edit?')->with('status', 'Tanggal Akhir harus lebih besar dari Tanggal Awal');
                } else {
                    DB::table('promotions')->where('id', $id)->update(['start_date' => Input::get('tanggal_awal'), 'end_date' => Input::get('tanggal_akhir'), 'content' => Input::get('content_text'),'template_type' => Input::get('template'), 'discount_value' => Input::get('discount')]);
                        return Redirect::to(route('promotions.index'));
                }
                
        }
        
    }
}
