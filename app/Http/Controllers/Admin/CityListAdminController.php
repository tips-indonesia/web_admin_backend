<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CityList;
use App\CountryList;
use App\ProvinceList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CityListAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = CityList::paginate(10);
        return view('admin.citylists.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        return view('admin.citylists.create');
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
            return Redirect::to(route('citylists.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $cityList = new CityList;
            $cityList->name = Input::get('name');
            $cityList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('citylists.index'));
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
        $cityList = CityList::find($id);
        $data['datas'] =  $cityList;
        return view('admin.citylists.edit', $data);
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
            return Redirect::to(route('citylists.edit', $id))
                ->withErrors($validator)
                ->withInput();
        } else {
            $cityList = CityList::find($id);
            $cityList->name = Input::get('name');
            $cityList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('citylists.index'));
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
        $cityList = CityList::find($id);
        $cityList->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('citylists.index'));
    }
}