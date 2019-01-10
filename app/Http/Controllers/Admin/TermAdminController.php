<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Term;
use App\ConfigZ;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ConfigHunter;

class TermAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        $lang = 'id';
        if (isset($_GET['lang'])) {
            $lang = $_GET['lang'];
        }
        //
        $label = $lang == 'en' ? '_en' : '';

        $data['antar'] = ConfigZ::where('key', 'antar')->select('id', 'value' . $label . ' as value', 'comment')->first();
        if ($data['antar'] == null) {
            ConfigHunter::set("antar", "Terms and Agreement Here");
            $data['antar'] = ConfigZ::where('key', 'antar')->first();
        }
        $data['kirim'] = ConfigZ::where('key', 'kirim')->select('id', 'value' . $label . ' as value', 'comment')->first();
        if ($data['kirim'] == null) {
            ConfigHunter::set("kirim", "Terms and Agreement Here");
            $data['kirim'] = ConfigZ::where('key', 'kirim')->first();
        }
        $data['lang'] = $lang;
        return view('admin.terms.create', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {
        //


    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        //

    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        //
        $rules = array(
            'terms'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('terms.index'))
                ->withErrors($validator)
                ->withInput();
        } else {
            // $airlinesList = Term::find($id);
            // $airlinesList->content = Input::get('terms');
            // $airlinesList->save();
            $terms = Input::get('terms');
            $jenis = Input::get('jenis');
            ConfigHunter::set($jenis, $terms);
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('terms.index'));
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        //
    }
}
