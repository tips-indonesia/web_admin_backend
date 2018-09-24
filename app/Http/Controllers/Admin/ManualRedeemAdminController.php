<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\MemberList;
use App\Wallet; 
use App\ManualRedeem;
use App\ManualRedeemDetail;
use Illuminate\Support\Facades\Redirect;

class ManualRedeemAdminController extends Controller
{
    public function index() {
        if (Input::get('date')) {
            $data['date'] = Input::get('date');
        } else {
            $data['date'] = Carbon::now()->toDateString();
        }

        $items = ManualRedeem::where('tanggal', $data['date'])
                                     ->join('member_lists', 'manual_redeem.id_member', '=', 'member_lists.id')
                                     ->select('manual_redeem.*', 'member_lists.first_name', 'member_lists.last_name')
                                     ->get();

        foreach ($items as $item) {
            $detail = ManualRedeemDetail::selectRaw('id_manual_redeem, COUNT(item_name) as total_item, sum(qty * unit_price) as total_amount')
                                        ->where('id_manual_redeem', $item->id)
                                        ->groupBy('id_manual_redeem')
                                        ->first();

            $item['total_item'] = $detail->total_item;
            $item['total_amount'] = $detail->total_amount;
        }

        $data['datas'] = $items;
        return view('admin.manualredeem.index', $data);
    }

    public function create() {
        $data['date'] = $_GET['date'];

        $id = (isset($_GET['id_mr'])) ? $_GET['id_mr'] : -1;
        $data['items'] = ManualRedeemDetail::where('id_manual_redeem', $id)->get();
        $sum = 0;

        foreach ($data['items'] as $item) {
            $sum += $item->qty * $item->unit_price;
        }

        $data['total_amount'] = $sum;
        return view('admin.manualredeem.create', $data);
    }

    public function getMemberList(Request $request) {
        $batas = 10;
        $skipped = $request->input('skipped') * $batas;
        $members = MemberList::select('id', 'first_name', 'last_name', 'mobile_phone_no', 'address');
        if ($request->get('query') && $request->get('query') != 'all') {
            $members = $members->where('first_name', 'LIKE', '%'.$request->get('query').'%');
        }
        $members = $members->skip($skipped)->take($batas)->get();
        
        foreach ($members as $member) {
            $wallet = Wallet::where('member_id', $member->id)
                            ->selectRaw('member_id, sum(debit) as total_debit, sum(credit) as total_kredit')
                            ->groupBy('member_id')
                            ->first();
            $member['wallet'] = ($wallet != null) ? $wallet->total_debit - $wallet->total_kredit : 0;
        }

        return response($members, 200);
    }

    public function store(Request $req) {
        $manualRedeem = new ManualRedeem;

        $manualRedeem->tanggal = $req->input('date');
        $manualRedeem->id_member = $req->input('member_id');

        $manualRedeem->save();

        // echo $manualRedeem->id;
        $manualRedeemDetail = new ManualRedeemDetail;
        $manualRedeemDetail->id_manual_redeem = $manualRedeem->id;
        $manualRedeemDetail->item_name = $req->input('item_name');
        $manualRedeemDetail->qty = $req->input('qty');
        $manualRedeemDetail->unit_price = $req->input('price');

        $manualRedeemDetail->save();

        // if (!isset($_GET['id_mr'])) {
        //     return Redirect::to(route('manualredeem.create').'?id_mr='.$manualRedeem->id.'&date='.$req->input('date'));
        // } else {
        //     return back();
        // }

        return Redirect::to(route('manualredeem.edit', $manualRedeem->id).'?date='.$req->input('date'));
    }

    public function edit($id) {
        $manualRedeem = ManualRedeem::find($id);

        $data['user'] = MemberList::find($manualRedeem->id_member);
        $wallet = Wallet::where('member_id', $data['user']->id)
                        ->selectRaw('member_id, sum(debit) as total_debit, sum(credit) as total_kredit')
                        ->groupBy('member_id')
                        ->first();
        $data['wallet'] = ($wallet != null) ? $wallet->total_debit - $wallet->total_kredit : 0;
        $data['date'] = $_GET['date'];

        $data['items'] = ManualRedeemDetail::where('id_manual_redeem', $id)->get();
        $sum = 0;

        foreach ($data['items'] as $item) {
            $sum += $item->qty * $item->unit_price;
        }

        $data['total_amount'] = $sum;
        $data['data'] = $manualRedeem;

        return view('admin.manualredeem.edit', $data);
    }

    public function update(Request $req, $id) {
        $manualRedeem = ManualRedeem::find($id);

        $manualRedeem->tanggal = $req->input('date');
        $manualRedeem->id_member = $req->input('id_mr');

        $manualRedeem->save();

        // echo $manualRedeem->id;
        $manualRedeemDetail = new ManualRedeemDetail;
        $manualRedeemDetail->id_manual_redeem = $manualRedeem->id;
        $manualRedeemDetail->item_name = $req->input('item_name');
        $manualRedeemDetail->qty = $req->input('qty');
        $manualRedeemDetail->unit_price = $req->input('price');

        $manualRedeemDetail->save();

        return back()->with('date', $req->input('date'));
    }
    public function destroy($id) {
        $data = ManualRedeemDetail::where('seq',$id)->first();
        $id_manual_redeem = $data->id_manual_redeem;
        ManualRedeemDetail::where('seq',$id)->delete();

        $dumm = ManualRedeemDetail::where('id_manual_redeem', $id_manual_redeem)->get();
        if (count($dumm) == 0 ) {
            $manual = ManualRedeem::find($id_manual_redeem);
            $manual->delete();
            return Redirect::to(route('manualredeem.index'));
        }

        return back();
    }
}
