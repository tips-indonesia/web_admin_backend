<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\OfficeList;
use Spatie\Permission\Models\Role;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DebugAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        for ($i=1; $i <= 14 ; $i++) { 
            $data['datas'][$i] = Shipment::where('id_shipment_status',$i)->get();

        }

        return view('admin.debugs.index', $data);
    }

}
