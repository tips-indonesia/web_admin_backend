@extends('admin.app')

@section('title')
    Print Picked Up Shipment Manifest
@endsection
@section('page_title')
    <span class="text-semibold">Print Picked Up Shipment Manifest</span> - Show
@endsection
@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        <div class="form-group">
            <label> Date : </label>
            <input type="text" class="form-control pickadate-year" value={{$date}} disabled readonly>
        </div>

        <div class="form-group">
            <label> Wroker name : </label>
            <input type="text" class="form-control" value={{$worker_name}} disabled readonly>
        </div>

         <div class="form-group">
            <label> Total Shipment : </label>
            <input type="text" class="form-control" value={{count($shipments)}} disabled readonly>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th> Shipment ID </th>
                    <th> Shipper First Name </th>
                    <th> Shipper Last Name </th>
                    <th> Origin </th>
                    <th> Destination </th>
                    <th> Shipment Content </th>
                    <th> Real Weight (Kg) </th>
                </tr>
            </thead>
            <tbody>
            @foreach($shipments as $shipment)
                <tr>
                    <td> {{ $shipment->shipment_id}} </td>
                    <td> {{ $shipment->shipper_first_name}} </td>
                    <td> {{ $shipment->shipper_last_name}} </td>
                    <td> {{ $shipment->origin}} </td>
                    <td> {{ $shipment->destination}} </td>
                    <td> {{ $shipment->shipment_contents}} </td>
                    <td> {{ $shipment->real_weight}} </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <button style="float: right" class="btn btn-primary" data-toggle="modal" data-target="#modal_manifest"> Print </button>
    </div>
</div>
<div id="modal_manifest" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width: 600px" id="qrcodex">
            <div class="modal-body">
                <b style="font-size: 30px; vertical-align: middle;">FORM TANDA TERIMA </b>
                <img src="{{ asset('images/logo_header2.png') }}" style="float:right; width: 140px; height: auto;">
                <div style="border-top: solid 4px black; width: 100%;"></div>
                <table style="font-size: 14px; font-weight: 700; width: 100%; margin-top: 10px; margin-bottom: 10px;">
                    <tr>
                        <td style="width: 60%;"> TPC : {{ $worker_name }}</td>
                        <td style="width: 40%;"> Tanggal: {{ $date }}</td>
                    </tr>
                </table>
                <style>
                    table.data td, table.data th {
                        border: solid 1px black;
                        padding: 4px 12px;
                    }
                </style>
                <table class="data" style="width: 100%;">
                    <thead style="font-weight: 700; text-align: center;">
                        <tr>
                            <th> NO </th>
                            <th> SHIPMENT ID </th>
                            <th> CONTENT </th>
                            <th> BERAT (KG) </th>
                            <th> KETERANGAN </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 ?>
                    @foreach($shipments as $shipment)
                        <tr>
                            <td> {{ $i }} </td>
                            <td> {{ $shipment->shipment_id}} </td>
                            <td> {{ $shipment->shipment_contents}} </td>
                            <td> {{ $shipment->real_weight}} </td>
                            <td> {{ $shipment->add_notes}} </td>
                        </tr>
                    <?php $i++ ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" id="print_manifest"> Print </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.select-search').select2();
    $('.pickadate-year').datepicker({
        format: 'yyyy-mm-dd',
    });
    $('#param').on('select2:select', function() {
        if ($('#param').val() != 'blank') {
            if (($('#param').val() == 'received') || ($('#param').val() == 'not_received')) {
                $('#value').prop('disabled', true);    
            } else {
                $('#value').prop('disabled', false);
                $('#value').prop('required', true)
            }
        } else {
            $('#value').prop('required', false)
        }
    });
    $(document).ready(function() {
        @if(session('received') !== null)
            window.alert("{{session('received')}}")      
        @endif
    })

    $('#print_manifest').click(() => {
            printManifest()
        })

        function printManifest() {
            var WinPrint = window.open('', '', 'letf=100,top=100,width=600,height=600');
            WinPrint.document.write(
                '<b style="font-size: 30px; vertical-align: middle;">FORM TANDA TERIMA </b>\
                <img src="{{ asset('images/logo_header2.png') }}" style="float:right; width: 140px; height: auto;">\
                <div style="border-top: solid 4px black; width: 100%; margin-top: 15px;"></div>\
                <table style="font-size: 14px; font-weight: 700; width: 100%; margin-top: 10px; margin-bottom: 10px;">\
                    <tr>\
                        <td style="width: 60%;"> TPC : {{ $worker_name }}</td>\
                        <td style="width: 40%;"> Tanggal: {{ $date }}</td>\
                    </tr>\
                </table>\
                <style>\
                    table.data td, table.data th {\
                        border: solid 1px black;\
                        padding: 4px 12px;\
                    }\
                </style>\
                <table class="data" style="width: 100%; border-collapse: collapse;">\
                    <thead style="font-weight: 700; text-align: center;">\
                        <tr>\
                            <th> NO </th>\
                            <th> SHIPMENT ID </th>\
                            <th> CONTENT </th>\
                            <th> BERAT (KG) </th>\
                            <th> KETERANGAN </th>\
                        </tr>\
                    </thead>\
                    <tbody>\
                    <?php $i = 1 ?>\
                    @foreach($shipments as $shipment)\
                        <tr>\
                            <td> {{ $i }} </td>\
                            <td> {{ $shipment->shipment_id}} </td>\
                            <td> {{ $shipment->shipment_contents}} </td>\
                            <td> {{ $shipment->real_weight}} </td>\
                            <td> {{ $shipment->add_notes}} </td>\
                        </tr>\
                    <?php $i++ ?>\
                    @endforeach\
                    </tbody>\
                </table>'
            )
            WinPrint.document.close();
            setTimeout(function() {
                WinPrint.focus();
                WinPrint.print();
            }, 500);
        }
</script>
@endsection