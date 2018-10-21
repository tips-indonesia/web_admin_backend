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
        }elseif(Input::get('bulan') === 'Desember') {
            $month = '12';
        }else {
            $month = date("m");
        }
       
        if(Input::get('tahun')) {
            $year = Input::get('tahun');
            $data = DB::table('promotions')->whereMonth('start_date','<=',$month)->whereMonth('end_date','>=',$month)->whereYear('start_date',$year)->get();
            session(['bulan' => Input::get('bulan')]);
            session(['tahun' => $year]);
            session(['bulanangka' => $month]);
        } else {
            $year = date("Y");
            $data = DB::table('promotions')->whereMonth('start_date','<=',date("n"))->whereMonth('end_date','>=',date("n"))->whereYear('start_date',date("Y"))->get();
            if(date("n") === '1') {
                session(['bulan' => 'Januari']);
            } elseif(date("n") === '2') {
                session(['bulan' => 'Februari']);
            } elseif(date("n") === '3') {
                session(['bulan' => 'Maret']);
            } elseif(date("n") === '4') {
                session(['bulan' => 'April']);
            } elseif(date("n") === '5') {
                session(['bulan' => 'Mei']);
            } elseif(date("n") === '6') {
                session(['bulan' => 'Juni']);
            } elseif(date("n") === '7') {
                session(['bulan' => 'Juli']);
            } elseif(date("n") === '8') {
                session(['bulan' => 'Agustus']);
            } elseif(date("n") === '9') {
                session(['bulan' => 'September']);
            } elseif(date("n") === '10') {
                session(['bulan' => 'Oktober']);
            } elseif(date("n") === '11') {
                session(['bulan' => 'November']);
            } else {
                session(['bulan' => 'Desember']);
            }
           
            // session(['tahun' => date("Y")]);
            // session(['bulanangka' => date("m")]);
        }
        
        return view('admin.promotions.index')->with('tahun',$tahun)
                                             ->with('seltahun', $year)
                                             ->with('selbulan', $month)
                                             ->with('bulan',$bulan)
                                             ->with('data', $data)
                                             ->with('namabulan', Input::get('bulan'))
                                             ->with('namatahun', Input::get('tahun'));
    }


    public function create() {
        $data['month'] = Input::get('month');
        $data['year'] = Input::get('year');
    	return view('admin.promotions.create', $data);
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
                ['start_date' => Input::post('tanggal_awal'), 'end_date' => Input::post('tanggal_akhir'), 'header' => Input::post('header_text'), 'content' => Input::post('content_text'),'template_type' => Input::post('template'), 'discount_value' => Input::post('discount'), 'discount_insurance' => Input::post('discount_insurance'), 'file_name' => $filename]
            );
            return redirect('admin/promotions/create');
        }


        
    }

    public function destroy($id)
    {
        //
        try {
            DB::table('promotions')->where('id',$id)->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                // report($e);
                return back()->withErrors("Can't delete data because violating database integrity constraint");
            }
        }
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
                    DB::table('promotions')->where('id', $id)->update(['start_date' => Input::get('tanggal_awal'), 'end_date' => Input::get('tanggal_akhir'), 'content' => Input::get('content_text'),'template_type' => Input::get('template'), 'discount_value' => Input::get('discount'), 'discount_insurance' => Input::post('discount_insurance'), 'file_name' => $filename]);
                    return Redirect::to(route('promotions.index'));
                }
                
        } else {
            if(Input::get('tanggal_awal') > Input::get('tanggal_akhir')) {
                    return redirect('admin/promotions/'.$id.'/edit?')->with('status', 'Tanggal Akhir harus lebih besar dari Tanggal Awal');
                } else {
                    DB::table('promotions')->where('id', $id)->update(['start_date' => Input::get('tanggal_awal'), 'end_date' => Input::get('tanggal_akhir'), 'content' => Input::get('content_text'),'template_type' => Input::get('template'), 'discount_value' => Input::get('discount'), 'discount_insurance' => Input::post('discount_insurance')]);
                        return Redirect::to(route('promotions.index'));
                }
                
        }
        
    }
}
