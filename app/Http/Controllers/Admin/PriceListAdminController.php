<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PriceList;
use App\CityList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PriceListAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = PriceList::paginate(10);
        foreach($data['datas'] as $dat) {
            $dat['dest_name'] = CityList::find($dat->id_destination_city)->name;
            $dat['origin_name'] = CityList::find($dat->id_origin_city)->name;
        }
        return view('admin.pricelists.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        $data['cities'] = CityList::all();
        return view('admin.pricelists.create', $data);
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
            'origin'       => 'required',
            'destination' => 'required',
            'tipster_price' => 'required',
            'freight_cost' => 'required',
            'add_first_class' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('pricelists.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $priceList = new PriceList;
            $priceList->id_origin_city = Input::get('origin');
            $priceList->id_destination_city = Input::get('destination');
            $priceList->tipster_price = Input::get('tipster_price');
            $priceList->freight_cost = Input::get('freight_cost');
            $priceList->add_first_class = Input::get('add_first_class');
            $priceList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('pricelists.index'));
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
        $priceList = PriceList::find($id);
        $data['datas'] =  $priceList;
        $data['cities'] = CityList::all();
        return view('admin.pricelists.edit', $data);
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
            'origin'       => 'required',
            'destination' => 'required',
            'tipster_price' => 'required',
            'freight_cost' => 'required',
            'add_first_class' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('pricelists.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $priceList = PriceList::find($id);
            $priceList->id_origin_city = Input::get('origin');
            $priceList->id_destination_city = Input::get('destination');
            $priceList->tipster_price = Input::get('tipster_price');
            $priceList->freight_cost = Input::get('freight_cost');
            $priceList->add_first_class = Input::get('add_first_class');
            $priceList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('pricelists.index'));
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
        $priceList = PriceList::find($id);
        $priceList->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('pricelists.index'));
    }
}
