<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SubdistrictList;
use App\ProvinceList;
use App\CityList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SubdistrictListAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = SubdistrictList::paginate(10);
        return view('admin.subdistrictlists.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        $data['provinces'] = ProvinceList::all();
        return view('admin.subdistrictlists.create', $data);
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
            'province' => 'required',
            'city' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('subdistrictlists.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $subdistrictList = new SubdistrictList;
            $subdistrictList->name = Input::get('name');
            $subdistrictList->id_province = Input::get('province');
            $subdistrictList->id_city = Input::get('city');
            $subdistrictList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('subdistrictlists.index'));
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
        $subdistrictList = SubdistrictList::find($id);
        $data['datas'] =  $subdistrictList;
        $data['provinces'] = ProvinceList::all();
        return view('admin.subdistrictlists.edit', $data);
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
            'province' => 'required',
            'city' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('subdistrictlists.edit', $id))
                ->withErrors($validator)
                ->withInput();
        } else {
            $subdistrictList = SubdistrictList::find($id);
            $subdistrictList->name = Input::get('name');
            $subdistrictList->id_province = Input::get('province');
            $subdistrictList->id_city = Input::get('city');
            $subdistrictList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('subdistrictlists.index'));
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
        $subdistrictList = SubdistrictList::find($id);
        $subdistrictList->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('subdistrictlists.index'));
    }
}
