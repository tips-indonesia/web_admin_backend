@extends('admin.app')

@section('title')
    Create Shipment List
@endsection
@section('page_title')
<span class="text-semibold">Shipment List</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            @foreach ($errors->all() as $error) {{ $error }} @endforeach
            {{ Form::open(array('url' => route('shipments.update', $data->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
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
                                <input type="radio" name="dispatch_type" @if($data->dispatch_type == 'Pickup to consignee"') checked="checked" @endif value="Pickup to consignee"">
                                Taken by consignee
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
                                    <select name="received_by" class="select-search" disabled readonly>
                                        <option disabled selected></option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @if($data->received_by == $user->id) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
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
                                                <label>Name :</label>
                                                <select name="shipper_name" class="select-search">
                                                    <option disabled selected></option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}" @if($data->id_shipper == $user->id) selected @endif>{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
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
                                                <label>Name :</label>
                                                {{ Form::text('consignee_name', $data->consignee_name, array('class' => 'form-control', 'placeholder' => 'Consignee Name')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Address :</label>
                                                <textarea rows="5" class="form-control" placeholder="Enter consignee address here" name="consignee_address">{{ $data->consignee_address }}</textarea>
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
                                            <input type="text" name="expired_date" class="form-control  pickadate-year" id="expired_date" placeholder="Expired date" value="{{ $data->card_expired_date }}" disabled>
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
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
        <script>
        $('.select-search').select2();
        $('.pickadate-year').datepicker({format: 'yyyy-mm-dd',});
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
        </script>
    </div>
@endsection