<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DangerousGoodsAddInfo;

class DangerousGoodsInfoController extends Controller
{
    public function index() {
        $data['infos'] = DangerousGoodsAddInfo::all();

        return view('admin.dangerousgoodsinfo.index', $data);
    }

    public function edit($id) {
        $data['info'] = DangerousGoodsAddInfo::find($id);

        return view('admin.dangerousgoodsinfo.edit', $data);
    }

    public function update(Request $req, $id) {
        $info = DangerousGoodsAddInfo::find($id);

        $info->description = $req->input('description');
        $info->description_en = $req->input('description_en');

        $info->save();

        return redirect('/admin/dangerousgoodsinfo');
    }
}
