<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CountryList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CountryListAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = CountryList::paginate(10);
        return view('admin.countrylists.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        return view('admin.countrylists.create');
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
            return Redirect::to(route('countrylists.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $countryList = new CountryList;
            $countryList->name = Input::get('name');
            $countryList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('countrylists.index'));
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
        $countryList = CountryList::find($id);
        $data['datas'] =  $countryList;
        return view('admin.countrylists.edit', $data);
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
            return Redirect::to(route('countrylists.edit'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $countryList = CountryList::find($id);
            $countryList->name = Input::get('name');
            $countryList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('countrylists.index'));
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
        $countryList = CountryList::find($id);
        $countryList->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('countrylists.index'));
    }
}
