<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GoodsCategory;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class GoodsCategoryAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = GoodsCategory::paginate(10);
        return view('admin.goodscategories.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        return view('admin.goodscategories.create');
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
            return Redirect::to(route('goodscategories.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $countryList = new GoodsCategory;
            $countryList->name = Input::get('name');
            $countryList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('goodscategories.index'));
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
        $countryList = GoodsCategory::find($id);
        $data['datas'] =  $countryList;
        return view('admin.goodscategories.edit', $data);
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
            return Redirect::to(route('goodscategories.edit'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $countryList = GoodsCategory::find($id);
            $countryList->name = Input::get('name');
            $countryList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('goodscategories.index'));
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
        $countryList = GoodsCategory::find($id);
        $countryList->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('goodscategories.index'));
    }
}
