<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DualLanguage;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\AppPageName;
use Illuminate\Support\Facades\URL;

class DualLanguageAdminController extends Controller
{
    public function index() {
        $id_page = 1;
        if (isset($_GET['id'])) {
            $id_page = $_GET['id'];
        }
        if (Input::get('param') && Input::get('value') && Input::get('param') != 'blank') {
            $duallanguage = DualLanguage::where(Input::get('param'), 'LIKE', '%'.Input::get('value').'%')->orderBy('text_key', 'asc');
        } else {
            $duallanguage = DualLanguage::orderBy('text_key', 'asc');
        }

        $duallanguage = $duallanguage->where('id_page_name', $id_page)->get();
        
        $data['param'] = Input::get('param');
        $data['value'] = Input::get('value');
        $data['datas'] = $duallanguage;
        $data['pages'] = AppPageName::all();
        $data['id_page'] = $id_page;
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

            return Redirect::to(route('duallanguage.index') . '?id=' . $duallanguage->id_page_name);
        }
    }

    public function update(Request $req, $id) {
        $duallanguage = DualLanguage::where('text_key', $req->input('text_key'))
                ->update([
                    'text_key' => $req->input('text_key'),
                    'text_id' => $req->input('text_id'),
                    'text_en' => $req->input('text_en')
                ]);
        
        $duallanguage = DualLanguage::where('text_key', $req->input('text_key'))->first();

        return Redirect::to(route('duallanguage.index') . '?id=' . $duallanguage->id_page_name);
    }

    public function edit($id) {
        $duallanguage = DB::table('dual_language')->where('text_key', $_GET['text_key'])->first();

        $data['data'] = $duallanguage;

        return view('admin.duallanguage.edit', $data);
    }

    public function show($id) {
        DualLanguage::where('text_key', $_GET['text_key'])->delete();


        return back();
    }
}
