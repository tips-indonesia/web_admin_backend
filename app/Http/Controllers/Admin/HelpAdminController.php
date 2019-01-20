<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HelpTipster;
use Illuminate\Support\Facades\Redirect;

class HelpAdminController extends Controller
{
    public function index() {
        $lang = 'id';
        if (isset($_GET['lang'])) {
            $lang = $_GET['lang'];
        }
        $label = $lang == 'en' ? '_en' : '';
        $helps = HelpTipster::select('id', 'title' . $label . ' as title')->get();

        $data['lang'] = $lang;
        $data['helps'] = $helps;
        return view('admin.help.index', $data);
    }

    public function edit($id) {
        $data['lang'] = $_GET['lang'];
        $label = $data['lang'] == 'en' ? '_en' : '';
        $help = HelpTipster::where('id', $id)
            ->select('id', 'title' . $label . ' as title', 'description' . $label . ' as description', 'addt_info' . $label . ' as addt_info')
            ->first();

        $data['help'] = $help;

        return view('admin.help.edit', $data);
    }

    public function update(Request $request, $id) {
        $lang = $request->input('lang');
        $label = $lang == 'en' ? '_en' : '';

        $help = HelpTipster::find($id);
        
        $help['title' . $label] = $request->input('title');
        $help['description' . $label] = $request->input('description');

        $help->save();

        return Redirect::to(route('help.index') . '?lang=' .$lang);
    }
}
