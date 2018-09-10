@extends('admin.app')

@section('title')
    Show Shipment Cancellation
@endsection
@section('page_title')
<span class="text-semibold">Shipment Cancellation</span> - Show
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        @if ($errors->any())
        <div class="alert alert-danger no-border">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
            <ul>
            @foreach($errors->getMessages() as $key => $message)
            <li>{{$key}} = {{$message[0]}}</li>
            @endforeach
            </ul>
        </div>
         @endif
        <div class="col-md-12">
            @foreach ($errors->all() as $error) {{ $error }} @endforeach
            {{ Form::open(array('url' => route('shipmentcancellation.update', $data->id), 'method' => 'PUT')) }}
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
                                        <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Transaction date" value={{$data->transaction_date}} disabled readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                    <label>Registration Type :</label>
                                    <input type="text" class="form-control" name="registration_type" value="{{$data->registration_type}}" disabled readonly>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Origin City :</label>
                                    <select name="origin_city" class="select-search" disabled readonly>
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
                                    <select name="destination_city" class="select-search" disabled readonly>
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
                                <input type="radio" name="class_type" @if($data->is_first_class == 0) checked="checked" @endif value="0" disabled readonly>
                                Regular
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="class_type" @if($data->is_first_class == 1) checked="checked" @endif value="1" disabled readonly>
                                First Class
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="display-block text-semibold">Dispatch Type :</label>
                            <label class="radio-inline">
                                <input type="radio" name="dispatch_type" @if($data->is_delivery) checked="checked" @endif value="Dispatch to consignee"  disabled readonly>
                                Dispatch to consignee
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="dispatch_type" @if(!$data->is_delivery) checked="checked" @endif value="Taken by consignee"  disabled readonly>
                                Taken by consignee
                            </label>
                        </div>
                        <!--div class="form-group">
                            <label class="display-block text-semibold">Goods Status :</label>
                            <label class="radio-inline">
                                <input type="radio" name="goods_status" value="Pending" @if($data->goods_status == 'Pending') checked @endif disabled>
                                Pending
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="goods_status"  value="Received" @if($data->goods_status == 'Received') checked @endif disabled>
                                Received
                            </label>
                        </div-->
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
                                    <input type="text" name="receive_by" class="form-control" value="{{ $data->received_by}}" disabled readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Received Date :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" name="received_date" class="form-control pickadate-year" placeholder="Received date" value="{{ $data->received_time }}" disabled readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <legend class="text-bold">Pickup</legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pickup By :</label>
                                    <select name="pickup_by" class="select-search"  disabled readonly>
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
                                        <input type="text" name="pickup_date" class="form-control pickadate-year" placeholder="Received date" value="{{$data->pickup_date}}"  disabled readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pickup Time :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" name="pickup_time" class="form-control pickatime" placeholder="Received date" value="{{$data->pickup_time}}" disabled readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                                <input type="text" class="form-control" name="shipper_first_name" value="{{$data->shipper_first_name}}" disabled readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Last Name :</label>
                                                <input type="text" class="form-control" name="shipper_last_name" value="{{$data->shipper_last_name}}" disabled readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Address :</label>
                                                <textarea rows="5" class="form-control" placeholder="Enter shipper address here" name="shipper_address" disabled readonly>{{ $data->shipper_address }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Address Detail :</label>
                                                <textarea rows="5" class="form-control" placeholder="Enter shipper address here" name="shipper_address_detail" disabled readonly>{{ $data->shipper_address_detail }}</textarea>
                                            <div class="form-group">
                                                <label>Mobile Phone :</label>
                                                {{ Form::text('shipper_mobile', $data->shipper_mobile_phone, array('class' => 'form-control', 'placeholder' => 'Shipper Mobile Phone', 'disabled' => '','readonly' => '')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Province :</label>
                                                <select name="shipper_province" id="sprovince" class="select-search" disabled="" readonly>
                                                    <option disabled></option>
                                                    @foreach ($provinces as $province)
                                                        <option value="{{ $province->id }}" {{$province->id==$data->province? 'selected' : ''}}>{{ $province->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>City :</label>
                                                <select name="shipper_city" id="scity" class="select-search" disabled="" readonly>
                                                    <option disabled></option>
                                                    @foreach ($citys as $city)
                                                        <option value="{{ $city->id }}" {{$city->id==$data->shipper_city ? 'selected' : ''}}>{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Subdistrict :</label>
                                                <select name="shipper_subdistrict" id="ssubdistrict" class="select-search" disabled="" readonly>
                                                    <option disabled ></option>
                                                    @foreach ($subdistricts as $city)
                                                        <option value="{{ $city->id }}" {{$city->id==$data->shipper_districts ? 'selected' : ''}}>{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Latitude :</label>
                                                {{ Form::text('shipper_latitude', $data->shipper_latitude, array('class' => 'form-control', 'placeholder' => 'Shipper Latitude', 'disabled' => '','readonly' => '')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Longitude :</label>
                                                {{ Form::text('shipper_longitude', $data->shipper_longitude, array('class' => 'form-control', 'placeholder' => 'Shipper Longitude', 'disabled' => '','readonly' => '')) }}
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-md-6">
                                    <legend class="text-bold">Consignee</legend>
                                    <div class="form-group">
                                        <label>First Name :</label>
                                        <input type="text" class="form-control" name="consignee_first_name" value="{{$data->consignee_first_name}}" disabled="" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name :</label>
                                        <input type="text" class="form-control" name="consignee_last_name" value="{{$data->consignee_last_name}}" disabled="" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label>Address :</label>
                                        <textarea rows="5" class="form-control" placeholder="Enter consignee address here" name="consignee_address" disabled="" readonly="">{{$data->consignee_address}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Address Detail :</label>
                                        <textarea rows="5" class="form-control" placeholder="Enter consignee address here" name="consignee_address_detail" disabled="" readonly="">{{$data->consignee_address_detail}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile Phone :</label>
                                        {{ Form::text('consignee_mobile', $data->consignee_mobile_phone, array('class' => 'form-control', 'placeholder' => 'Consignee Mobile Phone', 'disabled' => '')) }}
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
                                                {{ Form::text('shipment_content', $data->shipment_contents, array('class' => 'form-control', 'placeholder' => 'Shipment Content', 'disabled' => '')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Estimated Goods Value :</label>
                                                {{ Form::text('estimated_goods_value', $data->estimate_goods_value, array('class' => 'form-control', 'placeholder' => 'Estimated Goods Value', 'disabled' => '')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Estimated Weight :</label>
                                                {{ Form::number('estimated_weight', $data->estimate_weight, array('class' => 'form-control', 'placeholder' => 'Estimated Weight', 'disabled' => '')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Real Weight :</label>
                                                {{ Form::number('real_weight', $data->real_weight, array('class' => 'form-control', 'placeholder' => 'Real Weight', 'disabled' => '')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <legend class="text-bold">Costs</legend>
                                            <div class="form-group">
                                                <label class="display-block text-semibold">Additional Insurance :</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="additional_insurance" @if($data->is_add_insurance == 0) checked="checked" @endif value="0" disabled readonly>
                                                    No
                                                </label>

                                                <label class="radio-inline">
                                                    <input type="radio" name="additional_insurance" @if($data->is_add_insurance == 1) checked="checked" @endif  value="1" disabled readonly>
                                                    Yes
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label>Flight Cost :</label>
                                                {{ Form::number('flight_cost', $data->flight_cost, array('class' => 'form-control', 'placeholder' => 'Flight Cost', 'disabled' => '')) }}
                                            </div>

                                            <div class="form-group">
                                                <label>Insurance :</label>
                                                {{ Form::number('insurance', $data->insurance_cost, array('class' => 'form-control', 'placeholder' => 'Insurance Cost', 'disabled' => '')) }}
                                            </div>

                                            <div class="form-group">
                                                <label>Total :</label>
                                                {{ Form::number('total', $data->insurance_cost + $data->flight_cost, array('class' => 'form-control', 'placeholder' => 'Total Cost', 'disabled' => '')) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="payment">
                                    <div class="form-group">
                                        <label>Payment Type :</label>
                                        <select name="payment_type" class="select-search" id="payment_type" disabled readonly>
                                            <option disabled selected></option>
                                            @foreach ($payment_types as $payment_type)
                                                <option value="{{ $payment_type->id }}" @if($data->id_payment_type == $payment_type->id) selected @endif >{{ $payment_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="display-block text-semibold">Online Payment :</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="online_payment" @if($data->is_online_payment == 0) checked="checked" @endif  value="0" disabled readonly>
                                            No
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" name="online_payment" @if($data->is_online_payment == 1) checked="checked" @endif  value="1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Bank Name :</label>
                                        <select name="bank" class="select-search" id="bank" @if ($data->is_online_payment == 0) disabled @endif disabled readonly>
                                            <option disabled selected></option>
                                            @foreach ($banklists as $bank)
                                                <option value="{{ $bank->id }}" @if($data->id_bank == $bank->id) selected @endif>{{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Card Type :</label>
                                        <select name="card_type" class="select-search" id="card" @if ($data->is_online_payment == 0) disabled @endif disabled readonly>
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
                                        <input type="number" name="card_number" id="card_number" value="{{$data->card_no }}" class="form-control" placeholder="Card Number" @if($data->is_online_payment == 0) disabled @endif disabled readonly>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Security Code :</label>
                                        <input type="number" name="security_code" id="security_code" value="{{$data->card_security_code }}" class="form-control" placeholder="Card Number" @if($data->is_online_payment == 0) disabled @endif disabled readonly>
                                    </div> -->
                                    <div class="form-group">
                                        <label>Expired Date :</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                            <input type="text" name="expired_date" class="form-control  pickadate-year" id="expired_date" placeholder="Expired date" value="{{ $data->card_expired_date }}" disabled readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="notes">
                                    <div class="form-group">
                                        <label>Additional Notes :</label>
                                        <textarea rows="10" class="form-control" placeholder="Additional Notes" name="additional_notes">{{ $data->add_notes }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-danger" @if($data->id_shipment_status == 0) disabled @endif><i class="icon-trash position-left"></i>Cancel</button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
        <!-- Small modal -->
        <div id="modal_small" class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="width: 550px" id="qrcodex">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">QR Code</h5>
                    </div>

                    <div class="modal-body">
    <table style="width: 501px; border: solid 1px #777; background: rgba(0, 0, 0, .0); font-family: Arial">
        <tr style=" color: #777;">
            <td style="width: 150px;">
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->margin(0)->merge('/public/images/logoqr.png',.25)->encoding('UTF-8')->errorCorrection('H')->generate($data->shipment_id)) !!}" style="width: 150px; height: 150px;">
                <div style="width: 140px; text-align: center; background: #000; color: #FFF; padding: 5px; font-weight: bold;">
                    {!! $data->shipment_id !!}
                </div>
            </td>
            <td style="width: 1px">
                <div style="height: calc(150px + 1em + 15px); position: relative; width: 1px; background: #555; margin-top: 1px;"></div>
            </td>
            <td align="left" valign="top" style="padding-left: 8px; align: left; width: 350px;">
                <img src="{!! URL::to('/') . '/images/logo_header.png' !!}" style="height: 20px;">
                <table style="width: 350px; font-size: .7em;">
                    <tr>
                        <td style="width: 50%; margin-right: 2px; font-weight: bold;">
                            PENGIRIM <img src="{!! URL::to('/') . '/images/plane_icon_gray.png' !!}" style="height: 10px">
                        </td>
                        <td style="width: 50%; margin-right: 2px; font-weight: bold;">
                            PENERIMA <img src="{!! URL::to('/') . '/images/shipment_icon_gray.png' !!}" style="height: 10px">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; font-size: .9em;">
                            Nama : <br/>
                            <span style="color: #000">{{ $data->shipper_first_name . ' ' . $data->shipper_last_name }}</span>
                        </td>
                        <td style="width: 50%; font-size: .9em;">
                            Nama : <br/>
                            <span style="color: #000">{{$data->consignee_first_name . ' ' . $data->consignee_last_name}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; font-size: .9em;">
                            Alamat :<br/>
                            <span style="color: #000">{{ $data->shipper_address }}</span>
                        </td>
                        <td style="width: 50%; font-size: .9em;">
                            Alamat :<br/>
                            <span style="color: #000">{{ $data->consignee_address }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; font-size: .9em;">
                            No telp :<br/>
                            <span style="color: #000"> {{$data->shipper_mobile_phone}}</span>
                        </td>
                        <td style="width: 50%; font-size: .9em;">
                            No telp :<br/>
                            <span style="color: #000">{{$data->consignee_mobile_phone}}</span>
                        </td>
                    </tr>
                </table>
                <table style="font-size: .65em; margin-top: 5px;">
                    <tr>
                        <td valign="top">
                            <span style="font-weight: bold;">PT TIPS Inovasi Indonesia</span><br/>
                            DBS Bank Tower Lantai 12<br/>
                            Jl. Prof. Dr. Satrio Kav 3-5<br/>
                            Karet Kuningan, Jakarta Selatan
                        </td>
                        <td valign="top" style="padding-left: 24px">
                            <span style="font-weight: bold;">Download our free apps</span><br/>
                            <div style=" padding-top: 2px;">
                                <img src="{!! URL::to('/') . '/images/gs.jpg' !!}" height="30px;">   
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div style="width: 100%; height: 1px; background: #555"></div>
            </td>
        </tr>
        <tr>
            <td colspan="3" valign="top">
                <div style="width: 100%; height: 17px; text-align: center;">
                    <!--<img src="brands/dribbble.png" style="height: 15px; border-radius: 50%;">-->
                    <span style="margin-right: 25px; font-size: .7em; position: relative; top: -5px;">tips.co.id</span>
                    <!--<img src="brands/facebook.png" style="height: 15px; border-radius: 50%;">-->
                    <span style="margin-right: 25px; font-size: .7em; position: relative; top: -5px;">@tips.inovasi.id</span>
                    <!--<img src="brands/twitter.png" style="height: 15px; border-radius: 50%;">-->
                    <span style="margin-right: 25px; font-size: .7em; position: relative; top: -5px;">@TipsInovasi</span>
                    <!--<img src="brands/amazon.png" style="height: 15px; border-radius: 50%;">-->
                    <span style="margin-right: 25px; font-size: .7em; position: relative; top: -5px;">@tips.inovasi</span>
                </div>
            </td>
        </tr>
    </table> 
                    </div>

                    <div class="modal-footer">
                        <button>
                            <!-- <a style="font-size: 20px;" href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->merge('/public/images/logoqr.png',.25)->encoding('UTF-8')->errorCorrection('H')->generate($data->shipment_id)); !!}"
                                           download=<?=$data->shipment_id."_QRCode";?>>Print</a> -->
                            <a href="#" id="clickprint">Print</a>
                        </button>
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
    <table style="width: 501px; border: solid 1px #777; background: rgba(0, 0, 0, .0);">\
        <tr style=" color: #777;">\
            <td style="width: 150px;">\
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->margin(0)->merge('/public/images/logoqr.png',.25)->encoding('UTF-8')->errorCorrection('H')->generate($data->shipment_id)) !!} " style="width: 150px; height: 150px;">\
                <div style="width: 140px; text-align: center; background: #000; color: #FFF; padding: 5px; font-weight: bold;">\
                    {!! $data->shipment_id !!} \
                </div>\
            </td>\
            <td style="width: 1px">\
                <div style="height: calc(150px + 1em + 15px); position: relative; width: 1px; background: #555; margin-top: 1px;"></div>\
            </td>\
            <td align="left" valign="top" style="align: left; width: 350px;">\
                <img src="{!! URL::to('/') . '/images/logo_header.png' !!}" style="height: 20px;">\
                <table style="width: 350px; font-size: .7em;">\
                    <tr>\
                        <td style="width: 50%; margin-right: 2px; font-weight: bold;">\
                            PENGIRIM <img src="{!! URL::to('/') . '/images/plane_icon_gray.png' !!}" style="height: 10px">\
                        </td>\
                        <td style="width: 50%; margin-right: 2px; font-weight: bold;">\
                            PENERIMA <img src="{!! URL::to('/') . '/images/shipment_icon_gray.png' !!}" style="height: 10px">\
                        </td>\
                    </tr>\
                    <tr>\
                        <td style="width: 50%; font-size: .9em;">\
                            Nama : <br/>\
                            <span style="color: #000">{!!$data->shipper_first_name!!} {!!$data->shipper_last_name!!}</span>\
                        </td>\
                        <td style="width: 50%; font-size: .9em;">\
                            Nama : <br/>\
                            <span style="color: #000">{!!$data->consignee_first_name!!} {!!$data->consignee_last_name!!}</span>\
                        </td>\
                    </tr>\
                    <tr>\
                        <td style="width: 50%; font-size: .9em;">\
                            Alamat :<br/>\
                            <span style="color: #000">{!! $data->shipper_address !!}</span>\
                        </td>\
                        <td style="width: 50%; font-size: .9em;">\
                            Alamat :<br/>\
                            <span style="color: #000">{!! $data->consignee_address !!}</span>\
                        </td>\
                    </tr>\
                    <tr>\
                        <td style="width: 50%; font-size: .9em;">\
                            No telp :<br/>\
                            <span style="color: #000">{!! $data->shipper_mobile_phone !!}</span>\
                        </td>\
                        <td style="width: 50%; font-size: .9em;">\
                            No telp :<br/>\
                            <span style="color: #000">{!! $data->consignee_mobile_phone !!}</span>\
                        </td>\
                    </tr>\
                </table>\
                <table style="font-size: .65em; margin-top: 5px;">\
                    <tr>\
                        <td valign="top">\
                            <span style="font-weight: bold;">PT TIPS Inovasi Indonesia</span><br/>\
                            DBS Bank Tower Lantai 12<br/>\
                            Jl. Prof. Dr. Satrio Kav 3-5<br/>\
                            Karet Kuningan, Jakarta Selatan\
                        </td>\
                        <td valign="top" style="padding-left: 24px">\
                            <span style="font-weight: bold;">Download our free apps</span><br/>\
                            <div style=" padding-top: 2px;">\
                                <img src="{!! URL::to('/') . '/images/gs.jpg' !!}" height="30px;">\
                            </div>\
                        </td>\
                    </tr>\
                </table>\
            </td>\
        </tr>\
        <tr>\
            <td colspan="3">\
                <div style="width: 100%; height: 1px; background: #555"></div>\
            </td>\
        </tr>\
        <tr>\
            <td colspan="3" valign="top">\
                <div style="width: 100%; height: 17px; text-align: center;">\
                    <img src="brands/dribbble.png" style="height: 15px; borde\r-radius: 50%;">\
                    <span style="margin-right: 25px; font-size: .7em; position: relative; top: -5px;">tips.co.id</span>\
                    <img src="brands/facebook.png" style="height: 15px; border-radius: 50%;">\
                    <span style="margin-right: 25px; font-size: .7em; position: relative; top: -5px;">@tips.inovasi.id</span>\
                    <img src="brands/twitter.png" style="height: 15px; border-radius: 50%;">\
                    <span style="margin-right: 25px; font-size: .7em; position: relative; top: -5px;">@TipsInovasi</span>\
                    <img src="brands/amazon.png" style="height: 15px; border-radius: 50%;">\
                    <span style="margin-right: 25px; font-size: .7em; position: relative; top: -5px;">@tips.inovasi</span>\
                </div>\
            </td>\
        </tr>\
    </div>\
</body>\
</html>');
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            //WinPrint.close()
        }

        </script>
    </div>
@endsection