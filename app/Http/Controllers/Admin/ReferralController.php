<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Auth;
use Illuminate\Support\Facades\Input;
use App\Referral;

class ReferralController extends Controller
{
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
            $datas = DB::table('referral')->whereMonth('start_date','<=',$month)->whereMonth('end_date','>=',$month)->whereYear('start_date',$year)->get();
            session(['bulan' => Input::get('bulan')]);
            session(['tahun' => $year]);
            session(['bulanangka' => $month]);
        } else {
            $year = date("Y");
            $datas = DB::table('referral')->whereMonth('start_date','<=',date("n"))->whereMonth('end_date','>=',date("n"))->whereYear('start_date',date("Y"))->get();
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
           
            session(['tahun' => date("Y")]);
            session(['bulanangka' => date("m")]);
        }

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['selbulan'] = $month;
        $data['seltahun'] = $year;
        $data['data'] = $datas;
        $data['namabulan'] = Input::get('bulan');
        $data['namatahun'] = Input::get('tahun');

    	return view('admin.referral.index', $data);
    }

    public function create() {
    	return view('admin.referral.create');
    }

    public function store() {
    	$referral = new Referral;

		$referral->start_date = Input::get('tanggal_awal');
		$referral->end_date = Input::get('tanggal_akhir');
		$referral->referral_amount = Input::get('referral_amount');
		$referral->referred_amount = Input::get('referred_amount');

		$referral->save();

		return redirect('admin/referral');
    }

    public function edit($id) {
    	$referral = Referral::find($id);

    	$data['referral'] = $referral;
    	return view('admin.referral.edit', $data);
    }

    public function update($id) {
    	$referral = Referral::find($id);

		$referral->start_date = Input::get('tanggal_awal');
		$referral->end_date = Input::get('tanggal_akhir');
		$referral->referral_amount = Input::get('referral_amount');
		$referral->referred_amount = Input::get('referred_amount');

		$referral->save();

		return redirect('admin/referral');	
    }

    public function destroy($id) {
    	$referral = Referral::find($id);

    	$referral->delete();

    	return back();
    }
}
