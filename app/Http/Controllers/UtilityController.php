<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keberangkatan;
use App\Barang;
use App\DaftarBarangGold;
use App\DaftarBarangRegular;

class UtilityController extends Controller
{

    private $FINAL_HOURS = 4;
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

    /**
      * For debugging purpose
      *
      */
    private function printKeberangkatanSementara(){
        if(!$this->DEBUG)
            return;

        foreach (Keberangkatan::all() as $keberangkatan){
            echo 'K-' . $keberangkatan->id . ' dari ' . $keberangkatan->asal . ' menuju ' . $keberangkatan->tujuan . ', mengangkut ' . sizeof($keberangkatan->barang2) . ' barang, tersisa bagasi ' . $keberangkatan->berat_tersedia . ' muatan sbb:<br/>';
            foreach ($keberangkatan->barang2 as $barang){
                echo '> B-' . $barang->id . ', jenis ' . $barang->jenis . ', berat ' . $barang->berat . '<br/>';
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
        $keberangkatanTersedia = Keberangkatan::where('asal', $Barang->asal)
                -> where('tujuan', $Barang->tujuan)->get();

        if(sizeof($keberangkatanTersedia) == 0)
            return -1;

        foreach ($keberangkatanTersedia as $keberangkatan){
            if($keberangkatan->is_full)
                continue;

            $hoursDifferent = $this->hDiffTime($keberangkatan->dt_berangkat, $Barang->created_at);
            if($hoursDifferent >= $this->FINAL_HOURS && $Barang->berat <= $keberangkatan->berat_tersedia)
                return $keberangkatan->id;
            else
                continue;
        }

        return -1;
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
