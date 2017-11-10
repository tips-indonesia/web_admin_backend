<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WeightList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class WeightListAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = WeightList::paginate(10);
        return view('admin.weightlists.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        return view('admin.weightlists.create');
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
            'weight_kg'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('weightlists.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $WeightList = new WeightList;
            $WeightList->weight_kg = Input::get('weight_kg');
            $WeightList->status = 1;
            $WeightList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('weightlists.index'));
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
        $WeightList = WeightList::find($id);
        $data['datas'] =  $WeightList;
        return view('admin.weightlists.edit', $data);
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
            'weight_kg'       => 'required',
            'status'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('weightlists.edit'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $WeightList = WeightList::find($id);
            $WeightList->weight_kg = Input::get('weight_kg');
            $WeightList->status = Input::get('status');
            $WeightList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('weightlists.index'));
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
        $WeightList = WeightList::find($id);
        $WeightList->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('weightlists.index'));
    }
}
