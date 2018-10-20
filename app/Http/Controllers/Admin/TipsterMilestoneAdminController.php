<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TipsterMilestone;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\DeliveryStatus;

class TipsterMilestoneAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = DeliveryStatus::paginate(10);
        return view('admin.tipstermilestones.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        // return view('admin.tipstermilestones.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {
        //
        // $rules = array(
        //     'description'       => 'required',
        //     'step'       => 'required',
        // );
        // $validator = Validator::make(Input::all(), $rules);

        // // process the login
        // if ($validator->fails()) {
        //     return Redirect::to(route('tipstermilestones.create'))
        //         ->withErrors($validator)
        //         ->withInput();
        // } else {
        //     $tipsterMilestone = new TipsterMilestone;
        //     $tipsterMilestone->step = Input::get('step');
        //     $tipsterMilestone->description = Input::get('description');
        //     $tipsterMilestone->save();
        //     Session::flash('message', 'Successfully created data!');
        //     return Redirect::to(route('tipstermilestones.index'));
        // }

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
        $tipsterMilestone = DeliveryStatus::find($id);
        $data['datas'] =  $tipsterMilestone;
        return view('admin.tipstermilestones.edit', $data);
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
            'description'       => 'required',
            'step'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('tipstermilestones.edit'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $tipsterMilestone = DeliveryStatus::find($id);
            $tipsterMilestone->step = Input::get('step');
            $tipsterMilestone->description = Input::get('description');
            $tipsterMilestone->save();
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('tipstermilestones.index'));
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
        $tipsterMilestone = DeliveryStatus::find($id);
        $tipsterMilestone->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('tipstermilestones.index'));
    }
}
