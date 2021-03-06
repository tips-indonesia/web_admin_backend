<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProvinceList;
use App\CountryList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProvinceListAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = ProvinceList::paginate(10);
        return view('admin.provincelists.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        return view('admin.provincelists.create');
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
            return Redirect::to(route('provincelists.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $provinceList = new ProvinceList;
            $provinceList->name = Input::get('name');
            $provinceList->save();
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('provincelists.index'));
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
        $provinceList = ProvinceList::find($id);
        $data['datas'] =  $provinceList;
        return view('admin.provincelists.edit', $data);
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
            return Redirect::to(route('provincelists.edit', $id))
                ->withErrors($validator)
                ->withInput();
        } else {
            $provinceList = ProvinceList::find($id); $provinceList->name = Input::get('name');
            $provinceList->save();
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('provincelists.index'));
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
        $provinceList = ProvinceList::find($id);

        try {
            $provinceList->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                // report($e);
                return back()->withErrors("Can't delete data because violating database integrity constraint");
            }
        }

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('provincelists.index'));
    }
}
