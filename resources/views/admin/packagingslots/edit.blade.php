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
                        <div class="form-group">
                            <label>Status :</label>
                            @foreach ($slot_ids as $slot)
                            <input type="text" value="{{ $slot->id_slot_status == -1 ? 'Rejected' : 'Active' }}" class="form-control" disable readonly />
                            @endforeach
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-primary" disabled="">Submit form <i class="icon-arrow-right14 position-right"></i></button>
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
                        <label id="weight">Real Weight : </label>
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
            @foreach ($slot_ids as $slot)
                <button disabled="{{ $slot->id_slot_status == -1}}" type="button" class="btn btn-primary" id="hidden_btn" data-toggle="modal" data-target="#modal_small" style="float: right; display: none;">Print Label</button> 
            @endforeach
            </div>
            
            <div id="modal_small" class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="width: 400px" id="qrcodex">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Packaging Label</h5>
                    </div>
 
                <div class="modal-body" style="border: 2px solid black; margin-left: 20px; margin-right: 20px; padding: 0;">
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <img src="{{ asset('images/logoqr.png') }}" style="float:right; width: 120px; height: 120px; margin-bottom: 50px;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h1 style="font-weight: 900; padding-left: 15px;">{{ $data->packaging_id }}</h1>
                            </td>
                        </tr>
                    </table>
                    <table style="margin-top: -10px; width: 100%;">
                        <tr>
                            <td style="font-size:15px; background-color: black; color: white; border-top: solid 1px black; border-bottom: solid 1px black; padding-left: 15px; padding-right: 15px;">
                                <span id="slot_id">Slot {{ $slot->slot_id }}</span>
                            </td>
                            <td style="width: 59%;border-top: solid 1px; border-bottom: solid 1px;">
                                &nbsp;
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%; font-size: 12px; border-bottom: solid 1px;">
                        <style type="text/css">
                            .cp td {
                                border: solid 0.5px;
                                padding: 4px 12px;
                            }
                            td.bot {
                                padding-top: 4px;
                                padding-left: 4px;
                                padding-bottom: 20px;
                            }
                            td.head {
                                padding-left: 15px;
                                padding-right: 25px;
                            }
                        </style>
                        <tr style="border-bottom: solid 0.5px;">
                            <td class="bot head">
                                From
                            </td>
                            <td class="bot">
                                :
                            </td>
                            <td class="bot">
                                <span id="origin1"></span>
                            </td>
                        </tr>
                        <tr style="height: 45px;">
                            <td class="bot head">
                                To
                            </td>
                            <td class="bot">
                                :
                            </td>
                            <td class="bot">
                                <div style="position : absolute; margin-top: 0px; margin-left : -4px; border-top: solid 1.5px; border-left: solid 1.5px; height: 10px; width: 10px;"></div>
                                <div style="position : absolute; margin-top: 0px; border-top: solid 1.5px; border-right: solid 1.5px; height: 10px; width: 10px; margin-left: 255px;"></div>
                                <div style="position : absolute; margin-top: 25px; margin-left : -4px; border-bottom: solid 1.5px; border-left: solid 1.5px; height: 10px; width: 10px;"></div>
                                <div style="position : absolute; margin-top: 25px; margin-left : 255px; border-bottom: solid 1.5px; border-right: solid 1.5px; height: 10px; width: 10px;"></div>
                                <span id="destination1"></span>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%; font-size: 11px;" class="cp">
                        <tr>
                            <td rowspan="2" style="padding-left: 15px; width: 60%; vertical-align: top; text-align: left;">
                                <strong> PT TIPS Inovasi Indonesia </strong><br>
                                {{$office->address}}
                            </td>
                            <td style="width: 40%; vertical-align: top; text-align: left;">
                                <strong> Customer Service </strong><br>
                                +62 823 1777 6008
                            </td>
                        </tr>
                            <td style="width: 40%;">
                                &#9742; {{$office->phone_no}}<br>
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
        let v3 = "";
        let v4 = "";
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
                    v3 = data['office']['address'];
                    v4 = data['office']['phone_no'];
                    $('#destination').html('Destination Airport : ' + data['destination'] );
                    $('#origin').html('Origin Airport : ' + data['origin']);
                    $('#destination1').html(data['destination'] + ', ' + data['shipments'][0]['destination']);
                    document.getElementById("hidden_btn").style.display = "block";
                    $('#origin1').html(data['origin'] + ', ' + data['shipments'][0]['origin']);
                    $('#weight').html('Real Weight : ' + data['total_weight']);
                    // $('#slot_id').html(' : ' + data['id']);
                    var table = $('#shipments')
                    var body = table.find('tbody');
                    body.html('');
                    for (var i = 0; i < data['shipments'].length; i++) {
                        body.append("<tr><td>" + data['shipments'][i]['shipment_id'] + "</td><td>" + data['shipments'][i]['transaction_date'] + "</td><td>" + data['shipments'][i]['origin'] + "</td><td>" + data['shipments'][i]['destination'] + "</td><td>" + data['shipments'][i]['real_weight'] + "</td></tr>");
                        
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
        <div style="width:99%; border:1px solid black;" >\
                    <table style="width: 100%; border: none;">\
                        <tr>\
                            <td>\
                                <img src="{{ asset('images/logoqr.png') }}" style="float:right; width: 90px; height: 90px; margin-bottom: 20px;">\
                            </td>\
                        </tr>\
                        <tr>\
                            <td>\
                                <h1 style="font-size: 34px; padding-left: 15px;">{{ $data->packaging_id }}</h1>\
                            </td>\
                        </tr>\
                    </table>\
                    <table style="margin-top: -20px; width: 100%;">\
                        <tr>\
                            <td style="font-size:18px; background-color: black; color: white; border-top: solid 1px black; border-bottom: solid 1px black; padding-left: 15px; padding-right: 15px; padding-top: 5px; padding-bottom: 5px;">\
                                <span id="slot_id" style="font-weight:bold;">Slot {{ $slot->slot_id }}</span>\
                            </td>\
                            <td style="width: 50%;border-top: solid 1px; border-bottom: solid 1px;">\
                                &nbsp;\
                            </td>\
                        </tr>\
                    </table>\
                    <style type="text/css">\
                        .cp td {\
                            border: solid 0.5px;\
                            padding: 4px 12px;\
                        }\
                        td.bot {\
                            padding-top: 4px;\
                            padding-left: 4px;\
                            padding-bottom: 20px;\
                        }\
                        td.head {\
                            padding-left: 15px;\
                            padding-right: 25px;\
                        }\
                    </style>\
                    <table style="width: 100%; font-size: 12px; border-bottom: solid 1px;">\
                        <tr style="height: 60px; text-align: left; vertical-align: top; border-bottom: solid 1px;">\
                            <td class="bot head">\
                                From\
                            </td>\
                            <td class="bot">\
                                :\
                            </td>\
                            <td class="bot">\
                                <span id="origin1">' + v2 + '</span>\
                            </td>\
                        </tr>\
                    </table>\
                    <table style="width: 100%; font-size: 12px; border-bottom: solid 1px;">\
                        <tr style="height: 60px; text-align: left; vertical-align: top;">\
                            <td class="bot head">\
                                To\
                            </td>\
                            <td class="bot">\
                                :\
                            </td>\
                            <td class="bot">\
                                <div style="position : absolute; margin-top:-3px; margin-left : -4px; border-top: solid 1px; border-left: solid 1px; height: 10px; width: 10px;"></div>\
                                <div style="position : absolute; margin-top: -3px; border-top: solid 1px; border-right: solid 1px; height: 10px; width: 10px; right: 4%;"></div>\
                                <div style="position : absolute; margin-top: -3px; height: 10px; width: 10px; margin-left: 255px;"></div>\
                                <div style="position : absolute; margin-top: 42px; margin-left : -4px; border-bottom: solid 1px; border-left: solid 1px; height: 10px; width: 10px;"></div>\
                                <div style="position : absolute; margin-top: 42px; right: 4%; border-bottom: solid 1px; border-right: solid 1px; height: 10px; width: 10px;"></div>\
                                <span id="destination1">'+v1+'</span>\
                            </td>\
                        </tr>\
                    </table>\
                    <table style="width: 100%; font-size: 11px;" class="cp">\
                        <tr>\
                            <td rowspan="2" style="border-right: solid 0.5px; padding-left: 15px; width: 60%; vertical-align: top; text-align: left;">\
                                <strong> PT TIPS Inovasi Indonesia </strong><br>' + v3 + '\
                            </td>\
                            <td style="border-bottom: solid 0.5px; width: 40%; vertical-align: top; text-align: left;">\
                                <strong> Customer Service </strong><br>\
                                +62 823 1777 6008\
                            </td>\
                        </tr>\
                            <td style="width: 40%;">\
                                &#9742; '+ v4+'<br>\
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
            }, 500);
            //WinPrint.close()
        }

        
        </script>
    </div>
@endsection