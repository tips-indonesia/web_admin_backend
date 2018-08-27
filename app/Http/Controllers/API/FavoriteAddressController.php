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
    public function update(Request $request, $label) {
        $favAdd = FavoriteAddress::where('id_member', $request->input('id_member_'.$label))
                                ->where('keterangan_tempat', $request->input('keterangan_tempat_'.$label))
                                ->where('is_pengirim_penerima', $request->input('is_pengirim_penerima_'.$label))
                                ->first();

        $favAdd->is_pengirim_penerima =($label == 'pengirim') ? 1 : 0;
        $favAdd->id_member = $request->input('id_member_'.$label);
        $favAdd->keterangan_tempat = $request->input('keterangan_tempat_'.$label);
        $favAdd->first_name = $request->input('first_name_'.$label);
        $favAdd->last_name = $request->input('last_name_'.$label);
        $favAdd->mobile_phone_no = $request->input('mobile_phone_no_'.$label);
        $favAdd->address = $request->input('address_'.$label);
        if ($request->input('address_detail_'.$label)) {
            $favAdd->address_detail = $request->input('address_detail_'.$label);
        } else {
            $favAdd->address_detail = 'No Notes';
        }
        $favAdd->id_province = $request->input('id_province_'.$label);
        $favAdd->id_city = $request->input('id_city_'.$label);
        $favAdd->id_district = $request->input('id_district_'.$label);
        $favAdd->postal_code = $request->input('postal_code_'.$label);

        $favAdd->save();
    }

    public function store(Request $request, $label) {
        $favAdd = new FavoriteAddress;

        $favAdd->is_pengirim_penerima = ($label == 'pengirim') ? 1 : 0;
        $favAdd->id_member = $request->input('id_member_'.$label);
        $favAdd->keterangan_tempat = $request->input('keterangan_tempat_'.$label);
        $favAdd->first_name = $request->input('first_name_'.$label);
        $favAdd->last_name = $request->input('last_name_'.$label);
        $favAdd->mobile_phone_no = $request->input('mobile_phone_no_'.$label);
        $favAdd->address = $request->input('address_'.$label);
        if ($request->input('address_detail_'.$label)) {
            $favAdd->address_detail = $request->input('address_detail_'.$label);
        } else {
            $favAdd->address_detail = 'No Notes';
        }
        $favAdd->id_province = $request->input('id_province_'.$label);
        $favAdd->id_city = $request->input('id_city_'.$label);
        $favAdd->id_district = $request->input('id_district_'.$label);
        $favAdd->postal_code = $request->input('postal_code_'.$label);

        $favAdd->save();
    }
    public function addFavoriteAddress(Request $request, $label) {
        $rule = [
            'id_member_'.$label => 'required',
            'keterangan_tempat_'.$label => 'required',
            'first_name_'.$label => 'required',
            'last_name_'.$label => 'required',
            'mobile_phone_no_'.$label => 'required',
            'address_'.$label => 'required',
            'id_province_'.$label => 'required',
            'id_city_'.$label => 'required',
            'id_district_'.$label => 'required',
            'postal_code_'.$label => 'required',
        ];
        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            $data = array(
                'err' => [
                    'code' => 400,
                    'message' => 'Parameter id_member, keterangan_tempat, first_name, last_name, mobile_phone_no, address, id_province, id_city, id_district, postal_code tidak boleh kosong',
                    'validator' => $validate->errors()
                ],
                'result' => null
            );
        } else {
            $add = FavoriteAddress::where('id_member', $request->input('id_member'))
                                  ->where('keterangan_tempat', $request->input('keterangan_tempat'))
                                  ->where('is_pengirim_penerima', $request->input('is_pengirim_penerima'))
                                  ->first();
            if ($add) {
                $this->update($request, $label);
                $data = array(
                    'err' => null,
                    'result' => 'Data Favorite Address berhasil diupdate'
                ); 
            } else {
                $this->store($request, $label);
                $data = array(
                    'err' => null,
                    'result' => 'Data Favorite Address berhasil ditambahkan'
                );
            }
        }

        // return response()->json($data, 200);
        return $data;
    }
    public function storeFavAddressVerse2(Request $request, $label, $province) {
        $ketTempat = ($label == 'shipper') ? 'shipper_keterangan_tempat_pengirim' : 'consignee_keterangan_tempat_penerima';
        $add = FavoriteAddress::where('id_member', $request->input('id_shipper'))
                                ->where('keterangan_tempat', $request->input($ketTempat))
                                ->where('is_pengirim_penerima', ($label == 'pengirim') ? 1 : 0)
                                ->first();
        if ($add) {
            $favAdd = $add;
            $data = array(
                'err' => null,
                'result' => 'Data Favorite Address berhasil diupdate'
            ); 
        } else {
            $favAdd = new FavoriteAddress;
            $data = array(
                'err' => null,
                'result' => 'Data Favorite Address berhasil ditambahkan'
            );
        }

        $favAdd->is_pengirim_penerima = ($label == 'shipper') ? 1 : 0;
        $favAdd->id_member = $request->input('id_shipper');
        $favAdd->keterangan_tempat =  $request->input($ketTempat);
        $favAdd->first_name = $request->input($label.'_first_name');
        $favAdd->last_name = $request->input($label.'_last_name');
        $favAdd->mobile_phone_no = $request->input($label.'_mobile_phone');
        $favAdd->address = $request->input($label.'_address');
        if ($request->input($label.'_address_detail')) {
            $favAdd->address_detail = $request->input($label.'_address_detail');
        } else {
            $favAdd->address_detail = 'No Notes';
        }
        $favAdd->id_province = $province;
        $favAdd->id_city = $request->input('id_'.(($label == 'shipper') ? 'origin' : 'destination').'_city');
        $favAdd->id_district = $request->input('id_'.$label.'_district');
        $favAdd->postal_code = $request->input($label.'_postal_code');

        $favAdd->save();

        return $data;
    }

    public function storeFavoriteAddress(Request $request, $label) {
        $idmember = $request->input('id_member_'.$label);
        $ispengirim = $request->input('is_pengirim_penerima_'.$label);
        // Jumlah favorite address untuk tiap member ada 10 untuk masing - masing
        // data pengirim dan data penerima
        $address = FavoriteAddress::where('id_member', $idmember)
                                    ->where('is_pengirim_penerima', $ispengirim)
                                    ->get(); 
        if (count($address) > 10) {
            return response()->json([
                'err' => [
                    'code' => 412,
                    'message' => 'Jumlah Favorite Address maksimal 10 untuk masing - masing data pengirim dan penerima'
                ],
                'result' => null
            ], 200);
            return [
                'err' => [
                    'code' => 412,
                    'message' => 'Jumlah Favorite Address maksimal 10 untuk masing - masing data pengirim dan penerima'
                ],
                'result' => null
            ];
        } else {
            // return $this->addFavoriteAddress($request, $label);
            return $this->addFavoriteAddress($request, $label);
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

    public function deleteFavAddress($id) {
        $address = FavoriteAddress::find($id);

        $address->delete();
        return response()->json([
            'err' => null,
            'result' => "Favorite Address Deleted"
        ], 200);
    }

    public function isAlreadyFull(Request $request) {
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
            $data = array(
                'err' => null,
                'result' => (count($addresses) >= 10)
            );
        }
        return response()->json($data, 200);
    }
}
