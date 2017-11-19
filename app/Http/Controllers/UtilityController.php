<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SlotList;
use App\Barang;
use App\DaftarBarangGold;
use App\DaftarBarangRegular;

class UtilityController extends Controller
{

    private $FINAL_HOURS = 04;
    private $DEBUG = true;

    /**
      * For testing purpose
      *
      */
    public function test(){
        
        // Sebelum melakukan invoking method berikut, silahkan lakukan seed ulang
        // basis data agar perubahan dapat terlihat dan pastikan attribut DEBUG 
        // bernilai true.
        $this->RoutineMinuteAssignment();
    }

    /**
      * For debugging purpose
      *
      */
    private function printKeberangkatan(){
        if(!$this->DEBUG)
            return;

        foreach (Keberangkatan::all() as $keberangkatan){
            echo 'K-' . $keberangkatan->id . ' ' . $keberangkatan->asal . ' - ' . $keberangkatan->tujuan . ', tersedia ' . $keberangkatan->berat_tersedia . '<br/>';
        }
    }

    private function tambahBarang($barang){
        if(!$barang['jenis'])
            return false;

        $instanceBarang = Barang::create(array(
            'asal'          => $barang['asal'],
            'tujuan'        => $barang['tujuan'],
            'jenis'         => $barang['jenis'],
            'created_at'    => \Carbon\Carbon::createFromFormat('Y-m-d H:i', 
                               $barang['waktu_masuk'])->toDateTimeString(),
            'berat'         => $barang['berat'],
        ));
        if($barang['jenis'] == 'REGULAR')
            DaftarBarangRegular::create(array('id_barang' => $instanceBarang->id));
        else
            DaftarBarangGold::create(array('id_barang' => $instanceBarang->id));

        return $instanceBarang;
    }

    private function tambahSlotTipster($slot){
        $instanceSlot = SlotList::create(array(

            // STRING
            'slot_id'               => $slot['slot_id'],

            // DATE
            'slot_date'             => $slot['slot_date'],

            // TIME
            'slot_time'             => $slot['slot_time'],

            // UINT
            'id_member'             => $slot['id_member'],

            // UINT
            'id_flight_booking'     => $slot['id_flight_booking'],

            // UINT
            'id_airline'            => $slot['id_airline'],

            // UINT
            'id_origin_airport'     => $slot['id_origin_airport'],

            // UINT
            'id_destination_airport'=> $slot['id_destination_airport'],

            // TIME
            'departure_time'        => $slot['departure_time'],

            // DATE
            'departure_date'        => $slot['departure_date'],

            // DATE
            'arrival_date'          => $slot['arrival_date'],

            // TIME
            'arrival_time'          => $slot['arrival_time'],

            // UINT
            'baggage_space'         => $slot['baggage_space'],

            // UINT
            'sold_baggage_space'    => 0,

            // UINT
            'sold_baggage_space_kg' => 0,

            // UINT
            'slot_price_kg'         => $slot['slot_price_kg'],

            // STRING
            'status'                => $slot['status'],

            // UINT
            'create_by'             => $slot['create_by']
        ));

        return $instanceSlot;
    }

    /**
      * For debugging purpose
      *
      */
    private function printKeberangkatanSementara(){
        if(!$this->DEBUG)
            return;

        foreach (SlotList::all() as $keberangkatan){
            echo 'K-' . $keberangkatan->id . 
                 ' dari ' . $keberangkatan->airportOrigin->name . 
                 ' menuju ' . $keberangkatan->airportDestination->name . 
                 ', mengangkut ' . sizeof($keberangkatan->shipments) . 
                 ' barang, tersisa bagasi ' . ($keberangkatan->baggage_space - $keberangkatan->sold_baggage_space) . 
                 ' muatan sbb:<br/>';
            foreach ($keberangkatan->shipments as $barang){
                echo '> B-' . $barang->id . 
                     ', jenis ' . $barang->is_first_class ? 'GOLD' : 'REGULAR' . 
                     ', berat ' . $barang->estimate_weight . '<br/>';
            }
            echo "<br/>";
        }
    }

    /**
      * Mencari selisih waktu dari jenis Time String A dan B
      * dan mengembalikan selisih dalam jam
      *
      * @param  String  $strTimeA
      * @param  String  $strTimeB
      *
      * @return Double  Perbedaan waktu $strTimeA dan $strTimeB dalam jam
      */
    private function hDiffTime($strTimeA, $strTimeB){
        $t1 = StrToTime($strTimeA);
        $t2 = StrToTime($strTimeB);
        $diff = $t1 - $t2;

        return $diff / (60 * 60);
    }


    /**
      * Mencari ketersediaan keberangkatan untuk sebuah barang, jika ditemukan
      * dikembalikan indeks keberangkatan tersebut, jika tidak -1
      *
      * @param  App\Barang  $Barang
      *
      * @return Integer     ID keberangkatan yang tersedia, -1 jika tidak tersedia
      */
    public function CekKetersediaanKeberangkatan($Barang){
        $daftarAirportAsal = $Barang->cityOrigin->airports;
        $daftarAirportTujuan = $Barang->cityDestination->airports;

        $keberangkatanTersedia = array();
        foreach ($daftarAirportAsal as $airportAsal) {
            foreach ($daftarAirportTujuan as $airportTujuan) {
                array_push($keberangkatanTersedia, 
                    SlotList::where('id_origin_airport', $airportAsal->id)
                    -> where('id_destination_airport', $airportTujuan->id)->get());
            }
        }

        if(sizeof($keberangkatanTersedia) == 0)
            return -1;

        return $keberangkatanTersedia;
        // foreach ($keberangkatanTersedia as $keberangkatan){
        //     if($keberangkatan->is_full)
        //         continue;

        //     $hoursDifferent = $this->hDiffTime($keberangkatan->dt_berangkat, $Barang->created_at);
        //     if($hoursDifferent >= $this->FINAL_HOURS && $Barang->berat <= $keberangkatan->berat_tersedia)
        //         return $keberangkatan->id;
        //     else
        //         continue;
        // }

        // return -1;
    }


    /**
      * Melakukan assign satu barang ke sebuah keberangkatan yang diketahui
      * ID dari keberangkatan tersebut. Nilai kembali False mungkin sangat sulit
      * terjadi, tetapi ada kemungkinan.
      *
      * @param  App\Barang  $Barang
      * @param  Integer     $IDKeberangkatan
      *
      * @return Integer     True jika Assignment barang berhasil, False jika gagal
      */
    public function AssignBarangKeKeberangkatan($Barang, $IDKeberangkatan){

        $temp = Barang::find($Barang->id);

        if($temp == null)
            return false;

        if($this->DEBUG) echo "B-" . $temp->id . ' berat ' . $temp->berat . ' diassign ke K-' . $IDKeberangkatan . '<br/>';
        if($this->DEBUG) echo "</br>";
        $temp->id_keberangkatan = $IDKeberangkatan;
        $temp->status_barang = 'ASSIGNED';
        $temp->save();

        $tempK = Keberangkatan::find($IDKeberangkatan);

        if($tempK == null)
            return false;

        $tempK->berat_tersedia = $tempK->berat_tersedia - $Barang->berat;
        if($tempK->berat_tersedia == 0)
            $tempK->is_full = true;

        $tempK->save();

        $this->printKeberangkatan();
        echo "</br>";

        return true;
    }

    /**
      * Melakukan assignment antrian daftar barang pada basis data ke
      * keberangkatan yang ada. Sementara hanya REGULAR atau GOLD saja.
      *
      * @param  String  $Jenis
      */
    public function AssignDaftarBarangKeKeberangkatan($Jenis){

        $this->printKeberangkatan();

        $daftarBarang;

        if($Jenis == 'GOLD'){
            if($this->DEBUG) echo '<br/>-GOLD---------------------<br/><br/>';
            $daftarBarang = DaftarBarangGold::all();
        }
        
        if($Jenis == 'REGULAR'){
            if($this->DEBUG) echo '<br/>-REGULAR------------------<br/><br/>';
            $daftarBarang = DaftarBarangRegular::all();
        }

        foreach($daftarBarang as $_barang){
            $barang = $_barang->barang;
            $id = $this->CekKetersediaanKeberangkatan($barang);
            if($id != -1){
                $this->AssignBarangKeKeberangkatan($barang, $id);
                $_barang->delete();
            }else{
                if($this->DEBUG) echo "[X] B-" . $barang->id . ' berat ' . $barang->berat . ' tidak dapat diassign<br/>';
                if($this->DEBUG) echo "</br>";
            }
        }


        if($Jenis == 'GOLD'){
            if($this->DEBUG) echo '-GOLD---------------------<br/><br/><br/>';
        }
        
        if($Jenis == 'REGULAR'){
            if($this->DEBUG) echo '-REGULAR------------------<br/><br/><br/>';
        }
    }

    /**
      * Melakukan assignment antrian di seluruh daftar antrian baik 
      * GOLD atau REGULAR. Method ini rencananya akan di invoke per menit.
      *
      */
    public function RoutineMinuteAssignment(){
        $this->AssignDaftarBarangKeKeberangkatan("GOLD");
        $this->AssignDaftarBarangKeKeberangkatan("REGULAR");
        $this->printKeberangkatanSementara();
    }
}
