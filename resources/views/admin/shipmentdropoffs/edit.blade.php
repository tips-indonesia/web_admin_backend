@extends('admin.app')

@section('title')
    Create Shipment Dropoff List
@endsection
@section('page_title')
<span class="text-semibold">Shipment Dropoff List</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            @foreach ($errors->all() as $error) {{ $error }} @endforeach
            {{ Form::open(array('url' => route('shipmentdropoffs.update', $data->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Shipment ID :</label>
                                    <input type="text" class="form-control" value="{{$data->shipment_id}}" disabled readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Transaction date" value={{$data->transaction_date}}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                    <label>Registration Type :</label>
                                    <input type="text" class="form-control" name="registration_type" value="{{$data->is_take == 0 ? 'Online' : 'Offline'}}" readonly>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Origin City :</label>
                                    <select name="origin_city" class="select-search">
                                        <option disabled selected></option>
                                        @foreach ($cities as $origin_city)
                                            <option value="{{ $origin_city->id }}" @if ($data->id_origin_city == $origin_city->id) selected @endif>{{ $origin_city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Destination City :</label>
                                    <select name="destination_city" class="select-search">
                                        <option disabled selected></option>
                                        @foreach ($cities as $destination_city)
                                            <option value="{{ $destination_city->id }}"@if ($data->id_destination_city == $destination_city->id) selected @endif>{{ $destination_city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="display-block text-semibold">Class Type :</label>
                            <label class="radio-inline">
                                <input type="radio" name="class_type" @if($data->is_first_class == 0) checked="checked" @endif value="0">
                                Regular
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="class_type" @if($data->is_first_class == 1) checked="checked" @endif value="1">
                                First Class
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="display-block text-semibold">Dispatch Type :</label>
                            <label class="radio-inline">
                                <input type="radio" name="dispatch_type" @if($data->dispatch_type == 'Dispatch to consignee') checked="checked" @endif value="Dispatch to consignee">
                                Dispatch to consignee
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="dispatch_type" @if($data->dispatch_type == 'Taken by consignee') checked="checked" @endif value="Taken by consignee">
                                Taken by consignee
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="display-block text-semibold">Goods Status :</label>
                            <label class="radio-inline">
                                <input type="radio" name="goods_status" value="Pending" @if($data->goods_status == 'Pending') checked @endif>
                                Pending
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="goods_status"  value="Received" @if($data->goods_status == 'Received') checked @endif>
                                Received
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Shipment Status :</label>
                            <select name="shipment_status" class="select-search" disabled readonly>
                                <option disabled selected></option>
                                @foreach ($shipment_statuses as $shipment_status)
                                    <option value="{{ $shipment_status->id }}" @if($data->id_shipment_status == $shipment_status->id) selected @endif>{{ $shipment_status->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Received By :</label>
                                    <input type="text" name="receive_by" class="form-control" value="{{ $data->received_by}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Received Date :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" name="received_date" class="form-control pickadate-year" placeholder="Received date" value="{{ $data->received_time }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--legend class="text-bold">Pickup</legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pickup By :</label>
                                    <select name="pickup_by" class="select-search" >
                                        <option disabled></option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @if ($data->pickup_by == $user->id) selected @endif>{{ $user->first_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pickup Date :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" name="pickup_date" class="form-control pickadate-year" placeholder="Received date" value="{{$data->pickup_date}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pickup Time :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" name="pickup_time" class="form-control pickatime" placeholder="Received date" value="{{$data->pickup_time}}">
                                    </div>
                                </div>
                            </div>
                        </div-->
                        <div class="tabbable">
                            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                                <li class="active"><a href="#shipper_consignee" data-toggle="tab">Shipper & Consignee</a></li>
                                <li><a href="#goods_cost" data-toggle="tab">Goods Detail & Cost</a></li>
                                <li><a href="#payment" data-toggle="tab">Payment</a></li>
                                <li><a href="#notes" data-toggle="tab">Additional Notes</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="shipper_consignee">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <legend class="text-bold">Shipper</legend>
                                            <div class="form-group">
                                                <label>First Name :</label>
                                                <input type="text" class="form-control" name="shipper_first_name" value="{{$data->shipper_first_name}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Last Name :</label>
                                                <input type="text" class="form-control" name="shipper_last_name" value="{{$data->shipper_last_name}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Address :</label>
                                                <textarea rows="5" class="form-control" placeholder="Enter shipper address here" name="shipper_address">{{ $data->shipper_address }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Mobile Phone :</label>
                                                {{ Form::text('shipper_mobile', $data->shipper_mobile_phone, array('class' => 'form-control', 'placeholder' => 'Shipper Mobile Phone')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Province :</label>
                                                <select name="shipper_province" id="sprovince" class="select-search">
                                                    <option disabled></option>
                                                    @foreach ($provinces as $province)
                                                        <option value="{{ $province->id }}" {{$province->id==$data->id_shipper_province? 'selected' : ''}}>{{ $province->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>City :</label>
                                                <select name="shipper_city" id="scity" class="select-search">
                                                    <option disabled></option>
                                                    @foreach ($citys as $city)
                                                        <option value="{{ $city->id }}" {{$city->id==$data->id_shipper_city ? 'selected' : ''}}>{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Subdistrict :</label>
                                                <select name="shipper_subdistrict" id="ssubdistrict" class="select-search">
                                                    <option disabled ></option>
                                                    @foreach ($subdistricts as $city)
                                                        <option value="{{ $city->id }}" {{$city->id==$data->id_shipper_districts ? 'selected' : ''}}>{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Latitude :</label>
                                                {{ Form::text('shipper_latitude', $data->shipper_latitude, array('class' => 'form-control', 'placeholder' => 'Shipper Latitude')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Longitude :</label>
                                                {{ Form::text('shipper_longitude', $data->shipper_longitude, array('class' => 'form-control', 'placeholder' => 'Shipper Longitude')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <legend class="text-bold">Consignee</legend>
                                            <div class="form-group">
                                                <label>First Name :</label>
                                                <input type="text" class="form-control" name="consignee_first_name" value="{{$data->consignee_first_name}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Last Name :</label>
                                                <input type="text" class="form-control" name="consignee_last_name" value="{{$data->consignee_last_name}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Address :</label>
                                                <textarea rows="5" class="form-control" placeholder="Enter consignee address here" name="consignee_address">{{$data->consignee_address}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Mobile Phone :</label>
                                                {{ Form::text('consignee_mobile', $data->consignee_mobile_phone, array('class' => 'form-control', 'placeholder' => 'Consignee Mobile Phone')) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="goods_cost">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <legend class="text-bold">Goods Detail</legend>
                                            <div class="form-group">
                                                <label>Shipment Content :</label>
                                                {{ Form::text('shipment_content', $data->shipment_contents, array('class' => 'form-control', 'placeholder' => 'Shipment Content')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Estimated Goods Value :</label>
                                                {{ Form::text('estimated_goods_value', $data->estimate_goods_value, array('class' => 'form-control', 'placeholder' => 'Estimated Goods Value')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Estimated Weight :</label>
                                                {{ Form::number('estimated_weight', $data->estimate_weight, array('class' => 'form-control', 'placeholder' => 'Estimated Weight')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <legend class="text-bold">Costs</legend>
                                            <div class="form-group">
                                                <label class="display-block text-semibold">Additional Insurance :</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="additional_insurance" @if($data->is_add_insurance == 0) checked="checked" @endif value="0">
                                                    No
                                                </label>

                                                <label class="radio-inline">
                                                    <input type="radio" name="additional_insurance" @if($data->is_add_insurance == 1) checked="checked" @endif  value="1">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="payment">
                                    <div class="form-group">
                                        <label>Payment Type :</label>
                                        <select name="payment_type" class="select-search" id="payment_type" >
                                            <option disabled selected></option>
                                            @foreach ($payment_types as $payment_type)
                                                <option value="{{ $payment_type->id }}" @if($data->id_payment_type == $payment_type->id) selected @endif >{{ $payment_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="display-block text-semibold">Online Payment :</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="online_payment" @if($data->is_online_payment == 0) checked="checked" @endif  value="0">
                                            No
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" name="online_payment" @if($data->is_online_payment == 1) checked="checked" @endif  value="1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Bank Name :</label>
                                        <select name="bank" class="select-search" id="bank" @if ($data->is_online_payment == 0) disabled @endif>
                                            <option disabled selected></option>
                                            @foreach ($banklists as $bank)
                                                <option value="{{ $bank->id }}" @if($data->id_bank == $bank->id) selected @endif>{{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Card Type :</label>
                                        <select name="card_type" class="select-search" id="card" @if ($data->is_online_payment == 0) disabled @endif>
                                            <option disabled selected></option>
                                            @if ($data->is_online_payment == 1)
                                                @foreach ($bankcardlists as $bankcard)
                                                    <option value="{{ $bankcard->id }}" @if($data->bank_card_type == $bankcard->id) selected @endif>{{ $bankcard->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Card Number :</label>
                                        <input type="number" name="card_number" id="card_number" value="{{$data->card_no }}" class="form-control" placeholder="Card Number" @if($data->is_online_payment == 0) disabled @endif>
                                    </div>
                                    <div class="form-group">
                                        <label>Security Code :</label>
                                        <input type="number" name="security_code" id="security_code" value="{{$data->card_security_code }}" class="form-control" placeholder="Card Number" @if($data->is_online_payment == 0) disabled @endif>
                                    </div>
                                    <div class="form-group">
                                        <label>Expired Date :</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                            <input type="text" name="expired_date" class="form-control  pickadate-year" id="expired_date" placeholder="Expired date" value="{{ $data->card_expired_date }}" >
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="notes">
                                    <div class="form-group">
                                        <label>Additional Notes :</label>
                                        <textarea rows="10" class="form-control" placeholder="Additional Notes" name="addtional_notes">{{ $data->add_notes }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" name="submit" value="save" class="btn btn-primary">Save<i class="icon-arrow-right14 position-right"></i></button>
                            <button type="submit" name="submit" value="post" class="btn btn-success">Post<i class="icon-arrow-right14 position-right"></i></button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal_small">QR Code</i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
        <!-- Small modal -->
        <div id="modal_small" class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">QR Code</h5>
                        <center><h5 style="margin: 0px;" >{{ $data->shipment_id }}<h5></center>
                    </div>

                    <div class="modal-body">
                         <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->margin(0)->merge('\public\images\logoqr.png',.25)->encoding('UTF-8')->errorCorrection('H')->generate($data->shipment_id)) !!} ">
                    </div>

                    <div class="modal-footer">
                        @foreach ($cities as $origin_city)
                                            @if ($data->id_origin_city == $origin_city->id)
                                                <p style="float: left; font-size: 20px;">{{ $origin_city->name }} - </p>
                                            @endif
                        @endforeach
                        @foreach ($cities as $destination_city)
                                            @if ($data->id_destination_city == $destination_city->id)
                                                <p style="float: left; font-size: 20px;">-    {{ $destination_city->name }}</p>
                                            @endif
                        @endforeach
                        <button><a style="font-size: 20px;" href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->merge('\public\images\logo.png',.25)->encoding('UTF-8')->errorCorrection('H')->generate($data->shipment_id)); !!}"
                                           download=<?=$data->shipment_id."_QRCode";?>>Print</a></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /small modal -->
        <script>
        $('.select-search').select2();
        $('.pickadate-year').datepicker({format: 'yyyy-mm-dd',});
        $('.pickatime').timepicker({
            template : 'dropdown',
            showInputs: false,
            showSeconds: false,
            showMeridian: false
          });
        $('#bank').on('select2:select', function(){
            var card = $('#card');
            card.empty();
            $.ajax({
                url: '{{ route("banklists.index") }}/'+$('#bank').val(),
                data: {'ajax': 1},
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var option = new Option;
                    option.disabled = true;
                    option.selected = true;
                    card.append(option);
                    for(var i = 0 ; i < data.length; i++) {
                        card.append(new Option(data[i].name, data[i].id));
                    }
                }
            });
        });
    
        $('canvas').css("margin", "auto auto");
        $('canvas').css("display", "block");        
        $('input[name="online_payment"]').on('change', function(){
            if ($('input[name="online_payment"]:checked').val() == 0) {
                $('input[name="card_number"]').prop('disabled', 'disabled');
                $('input[name="security_code"]').prop('disabled', 'disabled');
                $('#card').prop('disabled', 'disabled');
                $('#bank').prop('disabled', 'disabled');
                $('#expired_date').prop('disabled', 'disabled');
            } else {
                $('input[name="card_number"]').removeAttr('disabled');
                $('input[name="security_code"]').removeAttr('disabled');
                $('#card').removeAttr('disabled');
                $('#bank').removeAttr('disabled');
                $('#expired_date').removeAttr('disabled');

            }
        });
        $('#sprovince').on('select2:select', function() {
                var city = $('#scity');
                city.empty();
                $.ajax({
                    url: '{{ route("citylists.index") }}',
                    data: {'ajax': 1, 'province' : $('#sprovince').val()},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var option = new Option;
                        option.disabled = true;
                        option.selected = true;
                        city.append(option);
                        for(var i = 0 ; i < data.length; i++) {
                            city.append(new Option(data[i].name, data[i].id));
                        }
                    }
                });
            });
        $('#scity').on('select2:select', function() {
                var subdistrict = $('#ssubdistrict');
                subdistrict.empty();
                $.ajax({
                    url: '{{ route("subdistrictlists.index") }}',
                    data: {'ajax': 1, 'city' : $('#scity').val()},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var option = new Option;
                        option.disabled = true;
                        option.selected = true;
                        subdistrict.append(option);
                        for(var i = 0 ; i < data.length; i++) {
                            subdistrict.append(new Option(data[i].name, data[i].id));
                        }
                    }
                });
            });
            var city = $('#scity');
                city.empty();
                $.ajax({
                    url: '{{ route("citylists.index") }}',
                    data: {'ajax': 1, 'province' : $('#sprovince').val()},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var option = new Option;
                        option.disabled = true;
                        city.append(option);
                        for(var i = 0 ; i < data.length; i++) {
                            var opt = new Option(data[i].name, data[i].id)
                            if (data[i].id == '{{ $data->id_shipper_city }}' ){
                                    opt.selected = true;    
                                }
                            city.append(opt);
                        }
                        var subdistrict = $('#ssubdistrict');
                        subdistrict.empty();
                        $.ajax({
                            url: '{{ route("subdistrictlists.index") }}',
                            data: {'ajax': 1, 'city' : $('#scity').val()},
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                var option = new Option;
                                option.disabled = true;
                                subdistrict.append(option);
                                for(var i = 0 ; i < data.length; i++) {
                                    var opt =new Option(data[i].name, data[i].id);
                                    if (data[i].id == '{{ $data->id_shipper_districts }}' ){
                                        opt.selected = true;    
                                    }
                                    
                                    subdistrict.append(opt);
                                }
                            }
                        });
                    }
                }); 
        </script>
    </div>
@endsection