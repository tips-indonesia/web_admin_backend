<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MemberList;
use App\CityList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class MemberListAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        $data['datas'] = MemberList::where('is_worker', 0)
                                    ->where('sms_code', -1);

        if (Input::get('param') && Input::get('value')) {
            $data['datas'] = $data['datas']->where(Input::get('param'), 'LIKE', '%'.Input::get('value').'%');
        }

        $data['datas'] = $data['datas']->paginate(10);
        return view('admin.memberlists.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        // $data['cities'] = CityList::all();
        // return view('admin.memberlists.create', $data);
        
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
        //     'name' => 'required',
        //     'birth_date' => 'required',
        //     'address' => 'required',
        //     'phone_no' => 'required',
        //     'email_address' => 'required',
        //     'city' => 'required',
        //     'password' => 'required|min:6|confirmed',
        // );
        // $validator = Validator::make(Input::all(), $rules);

        // // process the login
        // if ($validator->fails()) {
        //     return Redirect::to(route('memberlists.create'))
        //         ->withErrors($validator)
        //         ->withInput();
        // } else {
        //     $member = new MemberList;
        //     $member->name = Input::get('name');
        //     $member->birth_date = Input::get('birth_date');
        //     $member->registered_date = \Carbon\Carbon::now();
        //     $member->password = bcrypt(Input::get('password'));
        //     $member->address = Input::get('address');
        //     $member->mobile_phone_no = Input::get('phone_no');
        //     $member->email = Input::get('email_address');
        //     $member->id_city = Input::get('city');
        //     $member->save();
        //     Session::flash('message', 'Successfully created data!');
        //     return Redirect::to(route('memberlists.index'));
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
        $data['member'] = MemberList::find($id);
        $data['cities'] = CityList::all();
        return view('admin.memberlists.show', $data);
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
        // $data['member'] = MemberList::find($id);
        // $data['cities'] = CityList::all();
        // return view('admin.memberlists.edit', $data);

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
        // $rules = array(
        //     'name' => 'required',
        //     'birth_date' => 'required',
        //     'address' => 'required',
        //     'phone_no' => 'required',
        //     'email_address' => 'required',
        //     'city' => 'required',
        //     'password' => 'required|min:6|confirmed',
        // );
        // $validator = Validator::make(Input::all(), $rules);

        // // process the login
        // $changepass = false;
        // if ($validator->fails()) {
        //     return Redirect::to(route('memberlists.edit', $id))
        //         ->withErrors($validator)
        //         ->withInput();
        // } else {
        //     $member = MemberList::find($id);
        //     $member->name = Input::get('name');
        //     $member->birth_date = Input::get('birth_date');
        //     $member->registered_date = \Carbon\Carbon::now();
        //     $member->address = Input::get('address');
        //     $member->password = bcrypt(Input::get('password'));
        //     $member->mobile_phone_no = Input::get('phone_no');
        //     $member->email = Input::get('email_address');
        //     $member->id_city = Input::get('city');
        //     $member->save();
        //     Session::flash('message', 'Successfully created data!');
        //     return Redirect::to(route('memberlists.index'));
        // }
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
        // $member = MemberList::find($id);
        // $member->delete();

        // // redirect
        // Session::flash('message', 'Successfully deleted the nerd!');
        // return Redirect::to(route('memberlists.index'));
    }
}
