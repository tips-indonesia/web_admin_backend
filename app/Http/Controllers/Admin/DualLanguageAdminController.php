<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DualLanguage;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use DB;

class DualLanguageAdminController extends Controller
{
    public function index() {
        if (Input::get('param') && Input::get('value') && Input::get('param') != 'blank') {
            $duallanguage = DualLanguage::where(Input::get('param'), 'LIKE', '%'.Input::get('value').'%')->get();
        } else {
            $duallanguage = DualLanguage::all();
        }

        if (Input::get('bahasa')) {
            $data['bahasa'] = Input::get('bahasa');
        } else {
            $data['bahasa'] = 'ID';
        }
        $data['param'] = Input::get('param');
        $data['value'] = Input::get('value');
        $data['datas'] = $duallanguage;
        return view('admin.duallanguage.index', $data);
    }

    public function create() {
        $data['bahasa'] = (isset($_GET['bahasa'])) ? $_GET['bahasa'] : 'ID';

        return view('admin.duallanguage.create', $data);
    }

    public function store() {
        $rules = array(
            'pilihan_bahasa' => 'required',
            'key'       => 'required',
            'value'     => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $duallanguage = new DualLanguage();

            $duallanguage->lang_id = Input::get('pilihan_bahasa');
            $duallanguage->key = Input::get('key');
            $duallanguage->value = Input::get('value');

            $duallanguage->save();

            return Redirect::to(route('duallanguage.index'));
        }
    }

    public function update(Request $req, $id) {
        $duallanguage = DualLanguage::where('key', $req->input('key_default'))->where('value', $req->input('value_default'))
                ->update([
                    'key' => $req->input('key'),
                    'value' => $req->input('value') 
                ]);

        return Redirect::to(route('duallanguage.index'));
    }

    public function edit($id) {
        $duallanguage = DualLanguage::where('key', $_GET['key'])->where('value', $_GET['value'])->first();

        $data['data'] = $duallanguage;

        return view('admin.duallanguage.edit', $data);
    }

    public function show($id) {
        DualLanguage::where('key', $_GET['key'])->where('value', $_GET['value'])->delete();


        return back();
    }
}