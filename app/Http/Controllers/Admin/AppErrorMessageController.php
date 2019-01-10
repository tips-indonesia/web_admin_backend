<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ErrorDualLanguage;
use App\ErrorPageName;
use Illuminate\Support\Facades\Redirect;

class AppErrorMessageController extends Controller
{
    public function index() {
        $data['pages'] = ErrorPageName::all();

        $id_page = '1';
        if (isset($_GET['id_page'])) {
            $id_page = $_GET['id_page'];
        }

        $data['messages'] = ErrorDualLanguage::where('id_page_name', $id_page)->get();
        $data['selected_page'] = $id_page;

        return view('admin.apperrormessage.index', $data);
    }

    public function edit($key) {
        $message = ErrorDualLanguage::where('text_key', $key)->first();

        $data['page'] = ErrorPageName::find($message->id_page_name);
        
        $data['message'] = $message;
        return view('admin.apperrormessage.edit', $data);
    }

    public function update(Request $request, $key) {
        $message = ErrorDualLanguage::where('text_key', $key);

        $message->update([
            'text_id' => $request->input('text_id'),
            'text_en' => $request->input('text_en')
        ]);
        
        $message = $message->first();

        return Redirect::to(route('apperrormessage.index') . '?id_page=' . $message->id_page_name);
    }
}
