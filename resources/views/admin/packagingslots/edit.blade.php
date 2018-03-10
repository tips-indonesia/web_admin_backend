@extends('admin.app')

@section('title')
    Edit Packaging Slot
@endsection
@section('page_title')
<span class="text-semibold">Packaging Slot</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-body">
            {{ Form::open(array('method'=> 'PUT','url' => route('packagingslots.update', $data->id))) }}

                        <div class="form-group">
                            <label>Packaging Id :</label>
                            <input type="text" value= "{{ $data->packaging_id }}" class="form-control" disable readonly />
                        </div>
                        <div class="form-group">
                            <label>Slot Id :</label>
                            <select id="slot" name="slot" class="select-search" >
                                <option disabled selected></option>
                                @foreach ($slot_ids as $slot)
                                    <option value="{{ $slot->id }}" @if ($data->id_slot == $slot->id) selected @endif >{{ $slot->slot_id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
            {{ Form::close() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="origin">Origin City : </label>
                    </div>
                    <div class="form-group">
                        <label id="destination">Destination City : </label>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="weight">Estimated Weight : </label>
                    </div>                                
                </div>
            </div>
            <div class="panel panel-flat">
                <table class="table datatable-pagination" id="shipments">
                    <thead>
                        <tr>
                            <th>Shipment ID</th>
                            <th>Date</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Weight</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>

            </div>
             <button type="button" class="btn btn-primary" id="hidden_btn" data-toggle="modal" data-target="#modal_small" style="float: right; display: none;">Print Label</button> 
            </div>

            <div id="modal_small" class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="width: 650px" id="qrcodex">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Packaging Label</h5>
                    </div>
 
                <div class="modal-body" style="border: 2px solid black; margin-left: 20px; margin-right: 20px;">
                    <table>
                        <tr>
                        <img src="{{ asset('images/logoqr.png') }}" style="width: 150px; height: 150px; margin-bottom: 0;">
                    </tr>
                    <tr>
                        <h1 style="font-weight: 900;">{{ $data->packaging_id }}</h1>
                        </tr>
                        <tr>
                        <h3 id="slot_id">Slot {{ $slot->slot_id }}</h3>
                        </tr>
                        <tr>
                        <td>
                            <h3>From </h3>
                    </td>
                    <td>
                            <h3 id="origin1"></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                            <h3>To </h3>
                    </td>
                    <td>
                            <h3 id="destination1"></h3>
                    </td>
                </tr>
                    </table>
                </div>
        
                    <div class="modal-footer">
                        <button >
                            <a href="#" id="clickprint" style="font-size: 18px; margin: 5px 10px;">Print</a>
                        </button>
                    </div>




                    </div>
                </div>
        <script>
        
        let v1 = "";
        let v2 = "";
        function apicall() {
            $.ajax({
                url: '{{ route("slotlists.index") }}/' + $('#slot').val(),
                data: {'ajax': 1},
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    v1 = data['destination'] + ', ' + data['shipments'][0]['destination'];
                    v2 = data['origin'] + ', ' + data['shipments'][0]['origin'];
                    $('#destination').html('Destination Airport : ' + data['destination'] );
                    $('#origin').html('Origin Airport : ' + data['origin']);
                    $('#destination1').html(' : ' + data['destination'] + ', ' + data['shipments'][0]['destination']);
                    document.getElementById("hidden_btn").style.display = "block";
                    $('#origin1').html(' : ' + data['origin'] + ', ' + data['shipments'][0]['origin']);
                    $('#weight').html('Estimated Weight : ' + data['total_weight']);
                    // $('#slot_id').html(' : ' + data['id']);
                    var table = $('#shipments')
                    var body = table.find('tbody');
                    body.html('');
                    for (var i = 0; i < data['shipments'].length; i++) {
                        body.append("<tr><td>" + data['shipments'][i]['shipment_id'] + "</td><td>" + data['shipments'][i]['transaction_date'] + "</td><td>" + data['shipments'][i]['origin'] + "</td><td>" + data['shipments'][i]['destination'] + "</td><td>" + data['shipments'][i]['estimate_weight'] + "</td></tr>");
                        
                    }
                }
            });
        }
        $('.select-search').select2();
        $('#slot').on('select2:select', function(){
            apicall();
        });
        if ($('#slot').val() != '' || $('#slot').val() != null) {
            apicall();
        }

         $('#clickprint').click(()=>{
            PrintPartOfPage("modal_small");
        });

        function PrintPartOfPage(dvprintid){
            var prtContent = document.getElementById(dvprintid);
            var WinPrint = window.open('', '', 'letf=100,top=100,width=600,height=600');
            WinPrint.document.write('<!DOCTYPE html>\
                <html>\
            <head>\
                <title>PRINT QR TIPS</title>\
            </head>\
            <body style="font-family: Arial">\
        <style type="text/css">\
        * {\
                -webkit-print-color-adjust: exact !important;   /* Chrome, Safari */\
                color-adjust: exact !important;                 /*Firefox*/\
        }\
        </style>\
        <div style="width:500px; border:2px solid black; margin-left:20px; margin-right:20px;" >\
        <table>\
                        <tr>\
                        <img src="{{ asset('images/logoqr.png') }}" style="width: 150px; height: 150px; margin: 0;">\
                    </tr>\
                    <tr>\
                        <h1 style="font-weight: 900;">{{ $data->packaging_id }}</h1>\
                        </tr>\
                        <tr>\
                        <h3>Slot {{ $slot->slot_id }}</h3>\
                        </tr>\
                        <tr>\
                        <td>\
                            <h3>From : </h3>\
                    </td>\
                    <td>\
                            <h3 id="origin1">'+v2+'</h3>\
                    </td>\
                </tr>\
                <tr>\
                    <td>\
                            <h3>To : </h3>\
                    </td>\
                    <td>\
                            <h3 id="destination1">'+v1+'</h3>\
                    </td>\
                </tr>\
                    </table>\
                    </div>\
                </div>\
       </body>\
</html>');
            WinPrint.document.close();
            setTimeout(function() {
                WinPrint.focus();
                WinPrint.print();
            }, 250);
            //WinPrint.close()
        }

        
        </script>
    </div>
@endsection