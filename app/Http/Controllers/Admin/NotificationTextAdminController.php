<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NotificationText;
use App\NotificationHeader;
use Illuminate\Support\Facades\Redirect;

class NotificationTextAdminController extends Controller
{
    public function index() {
        $id_page = 1;
        if (isset($_GET['id'])) {
            $id_page = $_GET['id'];
        }
        $lang = 'id';
        if (isset($_GET['lang'])) {
            $lang = $_GET['lang'];
        }
        $label = $lang == 'en' ? '_en' : '';
        $texts = NotificationText::orderBy('text_key', 'asc')
                    ->where('id_page_name', $id_page)
                    ->select('text_key', 'text_push' . $label . ' as text_push', 'text_sms' . $label . ' as text_sms', 'id_page_name')
                    ->get();

        $data['pages'] = NotificationHeader::all();
        $data['texts'] = $texts;
        $data['id_page'] = $id_page;
        $data['lang'] = $lang;

        return view('admin.notificationtext.index', $data);
    }

    public function edit($id) {
        $lang = $_GET['lang'];
        $label = $lang == 'en' ? '_en' : '';

        $text = NotificationText::where('text_key', $id)
                    ->select('text_key', 'text_push' . $label . ' as text_push', 'text_sms' . $label . ' as text_sms', 'id_page_name')
                    ->first();
        $data['page'] = NotificationHeader::find($text->id_page_name);
        $data['text'] = $text;
        $data['lang'] = $lang;
        return view('admin.notificationtext.edit', $data);
    }

    public function update(Request $req, $id) {
        $lang = $req->input('lang');
        $label = $lang == 'en' ? '_en' : '';

        $text = NotificationText::where('text_key', $id)->first();

        $text['text_push' . $label] = $req->input('push_notif');
        $text['text_sms' . $label] = $req->input('sms_notif');

        $text->save();

        return Redirect::to(route('notificationtext.index') . '?lang=' .$lang . '&id=' . $text->id_page_name);
    }
}
