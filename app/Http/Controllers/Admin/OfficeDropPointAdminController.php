<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OfficeDropPoint;
use App\OfficeList;
use App\OfficeType;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OfficeDropPointAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create($office)
    {
        //
        $data['office'] = OfficeList::find($office);
        $data['drop_point'] = OfficeList::where('id', OfficeType::where('name', 'Drop Point')->first()->id)->get();
        return view('admin.officedroppoints.create', $data);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store($office)
    {
        //
        $rules = array(
            'drop_point'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('officedroppoints.create', $office))
                ->withErrors($validator)
                ->withInput();
        } else {
            $officedropPoint = new OfficeDropPoint;
            $officedropPoint->id_drop_point = Input::get('drop_point');
            $officedropPoint->id_office = $office;
            $officedropPoint->status = 1;
            $officedropPoint->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('officelists.show', $office));
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
    public function edit($office, $id)
    {
        //
        $officedropPoint = OfficeDropPoint::find($id);
        $data['datas'] =  $officedropPoint;
        $data['drop_point'] = OfficeList::where('id', OfficeType::where('name', 'Drop Point')->first()->id)->get();
        return view('admin.officedroppoints.edit', $data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($office, $id)
    {
        //
        $rules = array(
            'drop_point'       => 'required',
            'status'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('officedroppoints.edit', [$office, $id]))
                ->withErrors($validator)
                ->withInput();
        } else {
            $officedropPoint = OfficeDropPoint::find($id);
            $officedropPoint->id_drop_point = Input::get('drop_point');
            $officedropPoint->status = Input::get('status');
            $officedropPoint->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('officelists.show', $office));
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($office,$id)
    {
        //
        $officedropPoint = OfficeDropPoint::find($id);
        $officedropPoint->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('officelists.show', $office));
    }
}
