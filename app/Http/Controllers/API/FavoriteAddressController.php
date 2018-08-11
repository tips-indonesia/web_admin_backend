<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FavoriteAddress;
use Validator;
use App\ProvinceList;
use App\SubdistrictList;

class FavoriteAddressController extends Controller
{
    public function addFavoriteAddress(Request $request) {
        $rule = [
            'is_pengirim_penerima' => 'required',
            'id_member' => 'required',
            'keterangan_tempat' => 'required|unique:favorite_address',
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_phone_no' => 'required',
            'address' => 'required',
            'address_detail' => 'required',
            'id_province' => 'required',
            'id_city' => 'required',
            'id_district' => 'required',
            'postal_code' => 'required',
        ];
        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            $data = array(
                'err' => [
                    'code' => 400,
                    'message' => $validate->errors()
                ],
                'result' => null
            );
        } else {
            $favAdd = new FavoriteAddress;

            $favAdd->is_pengirim_penerima = $request->input('is_pengirim_penerima');
            $favAdd->id_member = $request->input('id_member');
            $favAdd->keterangan_tempat = $request->input('keterangan_tempat');
            $favAdd->first_name = $request->input('first_name');
            $favAdd->last_name = $request->input('last_name');
            $favAdd->mobile_phone_no = $request->input('mobile_phone_no');
            $favAdd->address = $request->input('address');
            $favAdd->address_detail = $request->input('address_detail');
            $favAdd->id_province = $request->input('id_province');
            $favAdd->id_city = $request->input('id_city');
            $favAdd->id_district = $request->input('id_district');
            $favAdd->postal_code = $request->input('postal_code');

            $favAdd->save();
            $data = array(
                'err' => null,
                'result' => 'Data Favorite Address berhasil ditambahkan'
            );
        }

        return response()->json($data, 200);
    }

    public function storeFavoriteAddress(Request $request) {
        $idmember = $request->input('id_member');
        $ispengirim = $request->input('is_pengirim_penerima');
        // Jumlah favorite address untuk tiap member ada 10 untuk masing - masing
        // data pengirim dan data penerima
        $address = FavoriteAddress::where('id_member', $idmember)
                                    ->where('is_pengirim_penerima', $ispengirim)
                                    ->get(); 
        if (count($address) >= 10) {
            return response()->json([
                'err' => [
                    'code' => 412,
                    'message' => 'Jumlah Favorite Address maksimal 10 untuk masing - masing data pengirim dan penerima'
                ],
                'result' => null
            ], 200);
        } else {
            return $this->addFavoriteAddress($request);
        }
    }

    public function getUserFavoriteAddress() {
        if (!isset($_GET['member_id']) || !isset($_GET['is_pengirim'])) {
            $data = array(
                'err' => [
                    'code' => 400,
                    'message' => 'Parameter member_id dan is_pengirim tidak boleh kosong'
                ],
                'result' => null
            );
        } else {
            $idmember = $_GET['member_id'];
            $ispengirim = $_GET['is_pengirim'];
            $addresses = FavoriteAddress::where('id_member', $idmember)
                                        ->where('is_pengirim_penerima', $ispengirim)
                                        ->get();
            foreach ($addresses as $add) {
                $add['province'] = ProvinceList::find($add->id_province)->name;
                $add['district'] = SubdistrictList::find($add->id_district)->name;
            }
            $data = array(
                'err' => null,
                'result' => $addresses
            );
        }
        return response()->json($data, 200);
    }
}
