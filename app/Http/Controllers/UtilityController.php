<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SlotList;
use App\Shipment;
use App\DaftarBarangGold;
use App\DaftarBarangRegular;

use Storage;

class UtilityController extends Controller
{

    private $FINAL_HOURS = 0;
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

        foreach (SlotList::all() as $keberangkatan){
            echo 'K-' . $keberangkatan->id . ' ' . $keberangkatan->airportOrigin->name . ' - ' . $keberangkatan->airportDestination->name . ', tersedia ' . ($keberangkatan->baggage_space - $keberangkatan->sold_baggage_space) . '<br/>';
        }
    }

    /**
        Contoh input barang:
        $barang = array(
            'shipment_id' => 'ASB1000',
            'transaction_date' => \Carbon\Carbon::createFromFormat('Y-m-d', '2017-11-7')->toDateTimeString(),
            'id_origin_city' => $c1->id,
            'id_destination_city' => $c2->id,
            'is_first_class' => true,
            'id_shipper' => 1,
            'shipper_name' => 'DIKA',
            'shipper_address' => 'Jalan',
            'shipper_mobile_phone' => '112',
            'shipper_latitude' => 12.22,
            'shipper_longitude' => 99.11,
            'consignee_name' => 'PAPA',
            'consignee_address' => 'Jalan2',
            'consignee_mobile_phone' => '911',
            'id_payment_type' => 0,
            'shipment_contents' => 'BUKU',
            'estimate_goods_value' => 5000,
            'estimate_weight' => 6,
            'insurance_cost' => 1000,
            'is_add_insurance' => true,
            'add_insurance_cost' => 102,
            'received_time' => \Carbon\Carbon::createFromFormat('Y-m-d H:i', '2017-11-7 12:00')->toDateTimeString(),
        );
      */
    private function tambahBarang($barang){
        $instanceBarang = Shipment::create($barang);

        if($barang['is_first_class'])
            DaftarBarangGold::create(array('id_barang' => $instanceBarang->id));
        else
            DaftarBarangRegular::create(array('id_barang' => $instanceBarang->id));

        return $instanceBarang;
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
      * @param  App\Shipment    $Barang
      *
      * @return Integer         ID keberangkatan yang tersedia, -1 jika tidak tersedia
      */
    public function CekKetersediaanKeberangkatan(Shipment $Barang){
        $daftarAirportAsal = $Barang->cityOrigin->airports;
        $daftarAirportTujuan = $Barang->cityDestination->airports;

        $keberangkatanTersedia = array();
        foreach ($daftarAirportAsal as $airportAsal) {
            foreach ($daftarAirportTujuan as $airportTujuan) {
                $result = SlotList::where('id_origin_airport', $airportAsal->id)
                    -> where('id_destination_airport', $airportTujuan->id)->get();

                if(sizeof($result) > 0)
                    foreach ($result as $value)
                        array_push($keberangkatanTersedia, $value);
            }
        }

        if(sizeof($keberangkatanTersedia) == 0)
            return -1;

        foreach ($keberangkatanTersedia as $keberangkatan){
            $isFull = (($keberangkatan->baggage_space - $keberangkatan->sold_baggage_space) <= 0);

            if($isFull)
                continue;

            $hoursDifferent = $this->hDiffTime($keberangkatan->depature, $Barang->received_time);
            if($hoursDifferent >= $this->FINAL_HOURS && $Barang->estimate_weight <= $keberangkatan->baggage_space)
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
      * @param  App\Shipment    $Barang
      * @param  Integer         $IDKeberangkatan
      *
      * @return Integer         True jika Assignment barang berhasil, False jika gagal
      */
    public function AssignBarangKeKeberangkatan(Shipment $Barang, $IDKeberangkatan){

        $temp = Shipment::find($Barang->id);

        if($temp == null)
            return false;

        if($this->DEBUG) echo "B-" . $temp->id . ' berat ' . $temp->estimate_weight . ' diassign ke K-' . $IDKeberangkatan . '<br/>';
        if($this->DEBUG) echo "</br>";
        $temp->id_slot = $IDKeberangkatan;
        $temp->status_dispatch = 'Process';
        $temp->save();

        $tempK = SlotList::find($IDKeberangkatan);

        if($tempK == null)
            return false;

        $tempK->sold_baggage_space = $tempK->sold_baggage_space + $Barang->estimate_weight;
        $tempK->status_dispatch = 'Process';
        // $tempK->id_slot_status = 2; // di delivery controller statusnya sudah otomatis 4

        FCMSender::post(array(
          'type' => "Delivery",
          'id' => $tempK->slot_id,
          'status' => "2",
          'message' => "Tes tes",
          'detail' => 'wkwkwk'
        ), $tempK->member->token);

        $tempK->id_slot_status = 2;
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
    public function AssignDaftarBarangKeKeberangkatan(String $Jenis){

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
            if($_barang->is_assigned)
              continue;

            $id = $this->CekKetersediaanKeberangkatan($barang);
            if($id != -1){
                $this->AssignBarangKeKeberangkatan($barang, $id);
                $_barang->is_assigned = true;
                $_barang->save();

            }else{
                if($this->DEBUG) echo "[X] B-" . $barang->id . ' berat ' . $barang->estimate_weight . ' tidak dapat diassign<br/>';
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

    public function CekDataAntrian(){
        foreach(Shipment::all() as $shipment){
            if(!$shipment->is_matched && $shipment->id_shipment_status == 4){
                if($shipment->is_first_class) {
                    $daftar_barang = new DaftarBarangGold;
                } else {
                    $daftar_barang = new DaftarBarangRegular;
                }

                $daftar_barang->id_barang = $shipment->id;
                $shipment->is_matched = true;
                $shipment->save();
                $daftar_barang->save();
            }
        }
    }

    /**
      * Melakukan assignment antrian di seluruh daftar antrian baik 
      * GOLD atau REGULAR. Method ini rencananya akan di invoke per menit.
      *
      */
    public function RoutineMinuteAssignment(){
        $this->CekDataAntrian();
        $this->AssignDaftarBarangKeKeberangkatan("GOLD");
        $this->AssignDaftarBarangKeKeberangkatan("REGULAR");
        $this->printKeberangkatanSementara();
    }


    // this is rio authority
    public function startcronjob(Request $request){
        if(!$request->cron_time)
            return 'cron_time parameter can not be null';

        if(!is_numeric($request->cron_time))
            return 'cron_time parameter must be numeric';

        # check if cronjob is running
        $cron_minutes_routine = ConfigHunter::isExist(ConfigHunter::$CRON_MINUTES_ROUTINE);
        if($cron_minutes_routine){
            if($cron_minutes_routine->value > 0){
                return "NOT OK: Cron job is running with minutes: " . $cron_minutes_routine->value . ". You can stop cron job using /api/cron/set/off";
            }
        }

        # set timezone
        date_default_timezone_set("Asia/Jakarta");

        # set time routine
        $min_r = ConfigHunter::set(ConfigHunter::$CRON_MINUTES_ROUTINE, $request->cron_time);

        # initialize iterator
        ConfigHunter::set(ConfigHunter::$CRON_ITERATOR_ROUTINE, $min_r->value);

        Storage::disk('public')->append('cron.txt', ">> Cronjob is starting: " . \Carbon\Carbon::now()->toDateTimeString());
        Storage::disk('public')->append('cron.txt', "waiting for the next cron job ...");

        return "OK: Start";
    }


    // this is rio authority
    public function stopcronjob(Request $request){        
        $cron_minutes_routine = ConfigHunter::isExist(ConfigHunter::$CRON_MINUTES_ROUTINE);
        if(!$cron_minutes_routine){
            return "NOT OK: Cron job is not running. You can start cron job using /api/cron/set/off?cron_time=[time minutes]";
        }

        if($cron_minutes_routine->value == 0){
            return "NOT OK: Cron job is not running. You can start cron job using /api/cron/set/off?cron_time=[time minutes]";                
        }

        date_default_timezone_set("Asia/Jakarta");
        ConfigHunter::set(ConfigHunter::$CRON_MINUTES_ROUTINE, "0");
        Storage::disk('public')->append('cron.txt', ">> Cronjob has stopped: " . \Carbon\Carbon::now()->toDateTimeString());

        return "OK: Stop";
    }

    // this is rio authority
    public function cronjobBegin(Request $request){
        # get cron configuration time routine (in minutes)
        $cron_minutes_routine = ConfigHunter::isExist(ConfigHunter::$CRON_MINUTES_ROUTINE);

        # case: configuration not found
        if(!$cron_minutes_routine){
            # set configuration to zero -> means "do not take any job"
            ConfigHunter::set(ConfigHunter::$CRON_MINUTES_ROUTINE, "0");
            return "NOT OK: Begin";
        }

        # case: time configuration set to zero -> means "do not take any job"
        if($cron_minutes_routine->value == 0){
            return "NOT OK: Crone is stopped";
        }

        # get cron iterator
        $cron_iterator = ConfigHunter::isExist(ConfigHunter::$CRON_ITERATOR_ROUTINE);

        # case: iterator not found
        if(!$cron_iterator){
            # initialized iterator
            ConfigHunter::set(ConfigHunter::$CRON_ITERATOR_ROUTINE, $cron_minutes_routine->value);
            Storage::disk('public')->append('cron.txt', "NOT OK: Iterator not initialized yet");
            return "NOT OK: Iterator not initialized yet";
        }


        ConfigHunter::set(ConfigHunter::$CRON_ITERATOR_ROUTINE, $cron_iterator->value - 1);
        # case: iterator still running
        if($cron_iterator->value > 1){
            # decrease iterator
            Storage::disk('public')->append('cron.txt', "OK: On Progress " . ($cron_minutes_routine->value - $cron_iterator->value + 1) . "/" . $cron_minutes_routine->value);
            return "OK: On Progress";
        }

        // DO YOUR JOB HERE
        $this->RoutineMinuteAssignment();

        date_default_timezone_set("Asia/Jakarta");
        Storage::disk('public')->append('cron.txt', "Cronjob begin: " . \Carbon\Carbon::now()->toDateTimeString());

        return "OK: Begin";
    }

    // this is rio authority
    public function cronjobEnd(Request $request){
        # get cron minutes
        $cron_minutes_routine = ConfigHunter::isExist(ConfigHunter::$CRON_MINUTES_ROUTINE);

        # get cron iterator
        $cron_iterator = ConfigHunter::isExist(ConfigHunter::$CRON_ITERATOR_ROUTINE);

        # case: some configuration not found
        if(!$cron_minutes_routine || !$cron_iterator){
            return "NOT OK: Begin";
        }

        # case: cron job is stopped
        if($cron_minutes_routine->value == 0){
            return "NOT OK: Begin";
        }

        # case: iterator still running
        if($cron_iterator->value > 0){
            Storage::disk('public')->append('cron.txt', "OK: Progress confirmed " . ($cron_minutes_routine->value - $cron_iterator->value) . "/" . $cron_minutes_routine->value);
            # decrease iterator
            return "OK: Progress confirmed";
        }

        ConfigHunter::set(ConfigHunter::$CRON_ITERATOR_ROUTINE, $cron_minutes_routine->value);

        date_default_timezone_set("Asia/Jakarta");
        Storage::disk('public')->append('cron.txt', "Cronjob end: " . \Carbon\Carbon::now()->toDateTimeString());
        Storage::disk('public')->append('cron.txt', "waiting for the next cron job ...");

        return "OK: End";
    }

    private function microtime_float(){
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    public function generateCode(Request $request){
        $n = $request->n;
        return (10**($n - 1)) . " - " . (10**$n - 1);
    }
}
