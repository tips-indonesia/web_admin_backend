<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BankList;
use App\BankCardList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BankListAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = BankList::paginate(10);
        return view('admin.banklists.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //
        return view('admin.banklists.create');
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
            return Redirect::to(route('banklists.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $bankList = new BankList;
            $bankList->name = Input::get('name');
            $bankList->status = 1;
            $bankList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('banklists.index'));
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
        if (Input::get('ajax') == 1) {
            return json_encode(BankCardList::where('id_bank', $id)->get(['id', 'name']));
        } else {
            $data['bank'] = BankList::find($id);
            $data['datas'] = BankCardList::where('id_bank', $id)->paginate(10);
            return view('admin.bankcardlists.index', $data);
        }
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
        $bankList = BankList::find($id);
        $data['datas'] =  $bankList;
        return view('admin.banklists.edit', $data);
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
            'status'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('banklists.edit'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $bankList = BankList::find($id);
            $bankList->name = Input::get('name');
            $bankList->status = Input::get('status');
            $bankList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('banklists.index'));
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
        $bankList = BankList::find($id);
        $bankList->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('banklists.index'));
    }
}
