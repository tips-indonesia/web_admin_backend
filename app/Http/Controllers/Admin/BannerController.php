<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Auth;
use Illuminate\Support\Facades\Input;
use App\HomeBanner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index() {
    	$data['banner'] = HomeBanner::first();

    	return view('admin.banner.index', $data);
    }

    public function store(Request $request) {
        $filename;
        if($request->hasFile('image')) {
                $avatar = $request->file('image');
                $filename = $avatar->getClientOriginalName();
                $avatar->storeAs('public/banner',$filename);
        }
        \Log::info($filename);
        
        // DB::table('home_banner')->insert(
        //     ['file_name' => $filename]
        // );
        $bann = new HomeBanner;
        $bann->file_name = $filename;

        $bann->save();

        return redirect('admin/banner');

    }

    public function update(Request $request, $id) {
     	$banner = HomeBanner::find($id);
        if($request->hasFile('image')) {
                unlink(storage_path('/app/public/banner/'.$banner->file_name));
                $avatar = $request->file('image');
                $filename = $avatar->getClientOriginalName();

                $banner->file_name = $filename;
                $banner->save();

                $avatar->storeAs('public/banner',$filename);

        }

        \Log::info($filename);

        return back();

    }
}
