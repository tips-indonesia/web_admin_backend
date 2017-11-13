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
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Origin City :</label>
                                <select name="origin_city" class="select-search" readonly disabled>
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
                                <select name="destination_city" class="select-search"  readonly disabled>
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
                            <input type="radio" name="class_type" @if($data->is_first_class == 1) checked="checked" @endif value="0"  readonly disabled>
                            Regular
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="class_type" @if($data->is_first_class == 0) checked="checked" @endif value="1"  readonly disabled>
                            First Class
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="display-block text-semibold">Dispatch Type :</label>
                        <label class="radio-inline">
                            <input type="radio" name="dispatch_type" @if($data->dispatch_type == 'D') checked="checked" @endif value="D" readonly disabled>
                            Dispatch to Consignee
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="dispatch_type" @if($data->dispatch_type == 'P') checked="checked" @endif value="P" readonly disabled>
                            Pickup by Consignee
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Shipment Status :</label>
                        <select name="shipment_status" class="select-search" readonly disabled>
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
                                <select name="received_by" class="select-search" readonly disabled>
                                    <option disabled selected></option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" >{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Received Date :</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                    <input type="text" name="received_date" class="form-control pickadate-year" placeholder="Received date">
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
                                            <select name="shipper_name" class="select-search" readonly disabled>
                                                <option disabled selected></option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" @if($data->id_shipper == $user->id) selected @endif>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Address :</label>
                                            <textarea rows="5" class="form-control" placeholder="Enter shipper address here" name="shipper_address" readonly disabled>{{ $data->shipper_address }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Phone :</label>
                                            {{ Form::text('shipper_mobile', $data->shipper_mobile_phone, array('class' => 'form-control', 'placeholder' => 'Shipper Mobile Phone', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>E-mail :</label>
                                            {{ Form::email('shipper_email_address', $data->shipper_email_address, array('class' => 'form-control', 'placeholder' => 'Shipper E-mail address', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>Latitude :</label>
                                            {{ Form::text('shipper_latitude', $data->shipper_latitude, array('class' => 'form-control', 'placeholder' => 'Shipper Latitude', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>Longitude :</label>
                                            {{ Form::text('shipper_longitude', $data->shipper_longitude, array('class' => 'form-control', 'placeholder' => 'Shipper Longitude', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <legend class="text-bold">Consignee</legend>
                                        <div class="form-group">
                                            <label>Name :</label>
                                            {{ Form::text('consignee_name', $data->consignee_name, array('class' => 'form-control', 'placeholder' => 'Consignee Name', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>Address :</label>
                                            <textarea rows="5" class="form-control" placeholder="Enter consignee address here" name="consignee_address" readonly disabled>{{ $data->consignee_address }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number :</label>
                                            {{ Form::text('consignee_phone', $data->consignee_phone_no, array('class' => 'form-control', 'placeholder' => 'Consignee Phone Number', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Phone :</label>
                                            {{ Form::text('consignee_mobile', $data->consignee_mobile_phone, array('class' => 'form-control', 'placeholder' => 'Consignee Mobile Phone', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>E-mail :</label>
                                            {{ Form::email('consignee_email_address', $data->consignee_email_address, array('class' => 'form-control', 'placeholder' => 'Consignee E-mail address', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
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
                                            {{ Form::text('shipment_content', $data->shipment_contents, array('class' => 'form-control', 'placeholder' => 'Shipment Content', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>Estimated Goods Value :</label>
                                            {{ Form::text('estimated_goods_value', $data->estimate_goods_value, array('class' => 'form-control', 'placeholder' => 'Estimated Goods Value' ,'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>Estimated Weight :</label>
                                            {{ Form::number('estimated_weight', $data->estimate_weight, array('class' => 'form-control', 'placeholder' => 'Estimated Weight', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
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
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="payment">
                                <div class="form-group">
                                    <label class="display-block text-semibold">Online Payment :</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="online_payment" @if($data->is_online == 0) checked="checked" @endif  value="0" disabled readonly>
                                        No
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" name="online_payment" @if($data->is_online == 1) checked="checked" @endif  value="1" disabled readonly>
                                        Yes
                                    </label>
                                </div>
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
                                    <label>Bank Name :</label>
                                    <select name="bank" class="select-search" id="bank" disabled readonly>
                                        <option disabled selected></option>
                                        @foreach ($banklists as $bank)
                                            <option value="{{ $bank->id }}" @if($data->id_bank == $bank->id) selected @endif>{{ $bank->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Card Type :</label>
                                    <select name="card_type" class="select-search" id="card" disabled readonly>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Card Number :</label>
                                    {{ Form::number('card_number', $data->card_no, array('class' => 'form-control', 'placeholder' => 'Card Number', 'disabled'=> 'disabled')) }}
                                </div>
                                <div class="form-group">
                                    <label>Security Code :</label>
                                    {{ Form::number('security_code', $data->card_security_code, array('class' => 'form-control', 'placeholder' => 'Card Security Number', 'disabled'=> 'disabled', 'readonly' => 'readonly')) }}
                                </div>
                                <div class="form-group">
                                    <label>Expired Date :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" name="expired_date" class="form-control pickadate-year" placeholder="Expired date" >
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="notes">
                                <div class="form-group">
                                    <label>Additional Notes :</label>
                                    <textarea rows="10" class="form-control" placeholder="Additional Notes" name="addtional_notes" disabled readonly>{{ $data->add_notes }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right form-group">
                        <button type="submit" name="submit" value="save" class="btn btn-primary" disabled readonly>Save<i class="icon-arrow-right14 position-right"></i></button>
                        <button type="submit" name="submit" value="post" class="btn btn-success" disabled readonly>Post<i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <script>
        $('.select-search').select2();
        $('.pickadate-year').pickadate({
            selectYears: 4
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
        $('input[name="online_payment"]').on('change', function(){
            if ($('input[name="online_payment"]:checked').val() == 0) {
                $('input[name="card_number"]').prop('disabled', 'disabled');
                $('input[name="security_code"]').prop('disabled', 'disabled');
                $('#card').prop('disabled', 'disabled');
                $('#bank').prop('disabled', 'disabled');
                $('#payment_type').prop('disabled', 'disabled');
            } else {
                $('input[name="card_number"]').removeAttr('disabled');
                $('input[name="security_code"]').removeAttr('disabled');
                $('#card').removeAttr('disabled');
                $('#bank').removeAttr('disabled');
                $('#payment_type').removeAttr('disabled');

            }
        }); 
        </script>
    </div>
@endsection