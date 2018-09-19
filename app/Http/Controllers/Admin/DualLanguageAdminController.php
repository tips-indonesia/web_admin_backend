<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DualLanguage;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

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
            'key'       => 'required',
            'value'     => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('duallanguage.create'))
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
        $duallanguage = DualLanguage::find($id);

        $duallanguage->lang_id = $req->input('pilihan_bahasa');
        $duallanguage->key = $req->input('key');
        $duallanguage->value = $req->input('value');

        $duallanguage->save();

        return Redirect::to(route('duallanguage.index'));
    }

    public function edit($id) {
        $duallanguage = DualLanguage::find($id);

        $data['data'] = $duallanguage;

        return view('admin.duallanguage.edit', $data);
    }

    public function destroy($id) {
        $duallanguage = DualLanguage::find($id);

        $duallanguage->delete();

        return back();
    }
}
