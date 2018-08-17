<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaymentType;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PaymentTypeAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = PaymentType::paginate(10);
        return view('admin.paymenttypes.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        return view('admin.paymenttypes.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {
        //
        $rules = array(
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('paymenttypes.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $countryList = new PaymentType;
            $countryList->name = Input::get('name');
            $countryList->save();
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('paymenttypes.index'));
        }

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
        $countryList = PaymentType::find($id);
        $data['datas'] =  $countryList;
        return view('admin.paymenttypes.edit', $data);
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
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('paymenttypes.edit'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $countryList = PaymentType::find($id);
            $countryList->name = Input::get('name');
            $countryList->save();
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('paymenttypes.index'));
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
        $countryList = PaymentType::find($id);
        $countryList->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('paymenttypes.index'));
    }
}
