<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Redeem;
use DB;
use Illuminate\Support\Facades\Input;

class RedeemController extends Controller
{
    public function index() {
    	$data['tahuns'] = DB::table('year_period')->get();
        $data['bulans'] = DB::table('month_period')->get();

        if (Input::get('bulan')) {
        	$data['selbulan'] = Input::get('bulan');
        } else {
        	$data['selbulan'] = date('n');
        }

        if (Input::get('tahun')) {
        	$data['seltahun'] = Input::get('tahun');
        } else {	   
        	$data['seltahun'] = date('Y');
        }

        $data['data'] = DB::table('redeem')->whereMonth('start_date','<=',$data['selbulan'])->whereMonth('end_date','>=',$data['selbulan'])->whereYear('start_date',$data['seltahun'])->get();
    	return view('admin.redeem.index', $data);
    }

    public function create() {
    	$data['month'] = Input::get('month');
        $data['month_word'] = DB::table('month_period')->where('id', Input::get('month'))->first()->nama;
        $data['year'] = Input::get('year');

    	return view('admin.redeem.create', $data);
    }

    public function store(Request $request) {
    	$filename;
        if($request->hasFile('image')) {
                $avatar = $request->file('image');
                $filename = uniqid(). '.'. $avatar->getClientOriginalExtension();
                $avatar->storeAs('public/redeem',$filename);
        }
        \Log::info($filename);


        if(Input::post('tanggal_awal') > Input::post('tanggal_akhir')) {
            return redirect('admin/promotions')->with('status', 'Tanggal Akhir harus lebih besar dari Tanggal Awal');
        } else {
            DB::table('redeem')->insert(
                ['start_date' => Input::post('tanggal_awal'), 'end_date' => Input::post('tanggal_akhir'), 'description' => Input::post('deskripsi'), 'remarks' => Input::post('keterangan'),'url' => Input::post('url'), 'file_name' => $filename]
            );
            return redirect('admin/redeem?bulan='.Input::post('selbulan').'&tahun='.Input::post('seltahun'));
        }
    }

    public function edit($id) {
    	$data = DB::table('redeem')->where('id', $id)->first();
        return view('admin.redeem.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
    	$filename;
        if($request->hasFile('image')) {
                $avatar = $request->file('image');
                $filename = uniqid(). '.'. $avatar->getClientOriginalExtension();
                $avatar->storeAs('public/redeem',$filename);

                if(Input::get('tanggal_awal') > Input::get('tanggal_akhir')) {
                    return redirect('admin/promotions/'.$id.'/edit?')->with('status', 'Tanggal Akhir harus lebih besar dari Tanggal Awal');
                } else {
                    DB::table('redeem')->update(
		                ['start_date' => Input::post('tanggal_awal'), 'end_date' => Input::post('tanggal_akhir'), 'description' => Input::post('deskripsi'), 'remarks' => Input::post('keterangan'),'url' => Input::post('url'), 'file_name' => $filename]
		            );
                    return back();
                }
                
        } else {
            if(Input::get('tanggal_awal') > Input::get('tanggal_akhir')) {
                    return redirect('admin/promotions/'.$id.'/edit?')->with('status', 'Tanggal Akhir harus lebih besar dari Tanggal Awal');
                } else {
                    DB::table('redeem')->update(
		                ['start_date' => Input::post('tanggal_awal'), 'end_date' => Input::post('tanggal_akhir'), 'description' => Input::post('deskripsi'), 'remarks' => Input::post('keterangan'),'url' => Input::post('url')]
		            );
                    return back();
                }
                
        }
    }

   	public function destroy($id) {
        //
        DB::table('redeem')->where('id',$id)->delete();

        // redirect
        // Session::flash('message', 'Successfully deleted the nerd!');
        return back();
    }
}
