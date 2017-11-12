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
            {{ Form::open(array('url' => route('shipments.store'))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Origin City :</label>
                                    <select name="origin_city" class="select-search">
                                        <option disabled selected></option>
                                        @foreach ($cities as $origin_city)
                                            <option value="{{ $origin_city->id }}">{{ $origin_city->name }}</option>
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
                                            <option value="{{ $destination_city->id }}">{{ $destination_city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="display-block text-semibold">Class Type :</label>
                            <label class="radio-inline">
                                <input type="radio" name="class_type" checked="checked" value="0">
                                Regular
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="class_type" value="1">
                                First Class
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="display-block text-semibold">Dispatch Type :</label>
                            <label class="radio-inline">
                                <input type="radio" name="dispatch_type" checked="checked" value="0">
                                Dispatch to Consignee
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="dispatch_type" value="1">
                                Pickup by Consignee
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Shipment Status :</label>
                            <select name="shipment_status" class="select-search">
                                <option disabled selected></option>
                                @foreach ($shipment_statuses as $shipment_status)
                                    <option value="{{ $shipment_status->id }}">{{ $shipment_status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Received By :</label>
                                    <select name="received_by" class="select-search">
                                        <option disabled selected></option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                                                <select name="shipper_name" class="select-search">
                                                    <option disabled selected></option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Address :</label>
                                                <textarea rows="5" class="form-control" placeholder="Enter shipper address here" name="shipper_address"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Mobile Phone :</label>
                                                {{ Form::text('shipper_mobile', null, array('class' => 'form-control', 'placeholder' => 'Shipper Mobile Phone')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>E-mail :</label>
                                                {{ Form::email('shipper_email_address', null, array('class' => 'form-control', 'placeholder' => 'Shipper E-mail address')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Latitude :</label>
                                                {{ Form::text('shipper_latitude', null, array('class' => 'form-control', 'placeholder' => 'Shipper Latitude')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Longitude :</label>
                                                {{ Form::text('shipper_longitude', null, array('class' => 'form-control', 'placeholder' => 'Shipper Longitude')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <legend class="text-bold">Consignee</legend>
                                            <div class="form-group">
                                                <label>Name :</label>
                                                {{ Form::text('consignee_name', null, array('class' => 'form-control', 'placeholder' => 'Consignee Name')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Address :</label>
                                                <textarea rows="5" class="form-control" placeholder="Enter consignee address here" name="consignee_address"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Phone Number :</label>
                                                {{ Form::text('consignee_phone', null, array('class' => 'form-control', 'placeholder' => 'Consignee Phone Number')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Mobile Phone :</label>
                                                {{ Form::text('consignee_mobile', null, array('class' => 'form-control', 'placeholder' => 'Consignee Mobile Phone')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>E-mail :</label>
                                                {{ Form::email('consignee_email_address', null, array('class' => 'form-control', 'placeholder' => 'Consignee E-mail address')) }}
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
                                                {{ Form::text('shipment_content', null, array('class' => 'form-control', 'placeholder' => 'Shipment Content')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Estimated Goods Value :</label>
                                                {{ Form::text('estimated_goods_value', null, array('class' => 'form-control', 'placeholder' => 'Estimated Goods Value')) }}
                                            </div>
                                            <div class="form-group">
                                                <label>Estimated Weight :</label>
                                                {{ Form::number('estimated_weight', null, array('class' => 'form-control', 'placeholder' => 'Estimated Weight')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <legend class="text-bold">Costs</legend>
                                            <div class="form-group">
                                                <label class="display-block text-semibold">Additional Insurance :</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="additional_insurance" checked="checked" value="0">
                                                    No
                                                </label>

                                                <label class="radio-inline">
                                                    <input type="radio" name="additional_insurance" value="1">
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
                                            <input type="radio" name="online_payment" checked="checked" value="0">
                                            No
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" name="online_payment" value="1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Payment Type :</label>
                                        <select name="payment_type" class="select-search">
                                            <option disabled selected></option>
                                            @foreach ($payment_types as $payment_type)
                                                <option value="{{ $payment_type->id }}">{{ $payment_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Bank Name :</label>
                                        <select name="bank" class="select-search" id="bank">
                                            <option disabled selected></option>
                                            @foreach ($banklists as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Card Type :</label>
                                        <select name="card_type" class="select-search" id="card">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Card Number :</label>
                                        {{ Form::number('card_number', null, array('class' => 'form-control', 'placeholder' => 'Card Number')) }}
                                    </div>
                                    <div class="form-group">
                                        <label>Security Code :</label>
                                        {{ Form::number('security_code', null, array('class' => 'form-control', 'placeholder' => 'Card Security Number')) }}
                                    </div>
                                    <div class="form-group">
                                        <label>Expired Date :</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                            <input type="text" name="expired_date" class="form-control pickadate-year" placeholder="Expired date">
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="notes">
                                    <div class="form-group">
                                        <label>Additional Notes :</label>
                                        <textarea rows="10" class="form-control" placeholder="Additional Notes" name="addtional_notes"></textarea>
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
                        card.append(new Option(data[i].id, data[i].name));
                    }
                }
            });
        });
        </script>
    </div>
@endsection