<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CityList;
use App\CountryList;
use App\ProvinceList;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CityListAdminController extends Controller
{

    public function index()
    {
        if (Input::get('ajax') == '1') {
            $cities = CityList::where('id_province', Input::get('province'))->get(['id', 'name']);
            return response()->json($cities);
        }
        $data['provinces'] = ProvinceList::all();
        if (Input::get('province')){
            $data['province'] = Input::get('province');
            $data['datas'] = CityList::where('id_province', Input::get('province'))->paginate(10);
        } else {
            $data['province'] = null;
            $data['datas'] = CityList::where('id_province', null)->paginate(10);
        }
        return view('admin.citylists.index', $data);
    }

    public function create()
    {
        if (Input::get('province')){
            $data['province'] = ProvinceList::find(Input::get('province'));
            return view('admin.citylists.create', $data);
        } else  {
            return $this->index();
        }
    }

    public function store()
    {
        //
        $rules = array(
            'name'       => 'required',
            'province' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('citylists.create', ['province' => Input::get('province')]) )
                ->withErrors($validator)
                ->withInput();
        } else {
            $cityList = new CityList;
            $cityList->name = Input::get('name');
            $cityList->id_province = Input::get('province');
            $cityList->save();
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to(route('citylists.index', ['province' => Input::get('province')]));
        }

    }

    public function edit($id)
    {
        //
        $cityList = CityList::find($id);
        $data['datas'] =  $cityList;
        $data['provinces'] = ProvinceList::all();
        return view('admin.citylists.edit', $data);
    }

    public function update($id)
    {
        $rules = array(
            'name'       => 'required',
            'province' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to(route('citylists.edit', $id))->withErrors($validator)->withInput();
        }

        $cityList = CityList::find($id);
        $cityList->name = Input::get('name');
        $cityList->id_province = Input::get('province');
        $cityList->save();
        return Redirect::to(route('citylists.index', ['province' => Input::get('province')]));
    }

    public function destroy($id)
    {
        $cityList = CityList::find($id);
        $cityList->delete();
        return Redirect::to(route('citylists.index', ['province' => Input::get('province')]));
    }
}
