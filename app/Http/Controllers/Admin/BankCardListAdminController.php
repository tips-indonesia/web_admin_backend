<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BankCardList;
use App\BankList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BankCardListAdminController extends Controller
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
    public function create($bank)
    {
        //
        $data['bank'] = BankList::find($bank);
        return view('admin.bankcardlists.create', $data);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store($bank)
    {
        //
        $rules = array(
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('bankcardlists.create', $bank))
                ->withErrors($validator)
                ->withInput();
        } else {
            $bankcardList = new BankCardList;
            $bankcardList->name = Input::get('name');
            $bankcardList->id_bank = $bank;
            $bankcardList->status = 1;
            $bankcardList->save();
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('banklists.show', $bank));
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
    public function edit($bank, $id)
    {
        //
        $bankcardList = BankCardList::find($id);
        $data['datas'] =  $bankcardList;
        return view('admin.bankcardlists.edit', $data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($bank, $id)
    {
        //
        $rules = array(
            'name'       => 'required',
            'status'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('bankcardlists.edit', [$bank, $id]))
                ->withErrors($validator)
                ->withInput();
        } else {
            $bankcardList = BankCardList::find($id);
            $bankcardList->name = Input::get('name');
            $bankcardList->status = Input::get('status');
            $bankcardList->save();
            Session::flash('message', 'Successfully created data!');
            return Redirect::to(route('banklists.show', $bank));
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($bank,$id)
    {
        //
        $bankcardList = BankCardList::find($id);
        $bankcardList->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to(route('banklists.show', $bank));
    }
}
