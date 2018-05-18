@extends('admin.app')

@section('title')
    Delivery Shipment
@endsection
@section('page_title')
    <span class="text-semibold">Delivery Shipment</span> - Detail
@endsection
	
@section('content')
		<div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Shipment ID :</label>
                                <input type="text" class="form-control" value="{{$shipment->shipment_id}}" disabled readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date :</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                    <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Transaction date" value={{$shipment->transaction_date}} disabled readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Registration Type :</label>
                                    <input type="text" class="form-control" name="registration_type" value="{{$shipment->registration_type}}" disabled readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::open(array('method' => 'PUT', 'url' => route('deliveryshipment.update', $shipment->id))) }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Origin City :</label>
                                <input class="form-control" type="text" value="{{$shipment->origin_city}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Destination City :</label>
                                <input class="form-control" type="text" value="{{$shipment->destination_city}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="display-block text-semibold">Class Type :</label>
                            <input  type="radio" name="class_type" @if($shipment->is_first_class == 1) checked="checked" @endif value="0"  readonly disabled>
                            Regular
                        </label>

                        <label class="radio-inline">
                            <input  type="radio" name="class_type" @if($shipment->is_first_class == 0) checked="checked" @endif value="1"  readonly disabled>
                            First Class
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="display-block text-semibold">Dispatch Type :</label>
                            <label class="radio-inline">
                                <input type="radio" name="dispatch_type" @if($shipment->dispatch_type == 'Dispatch to consignee') checked="checked" @endif value="Dispatch to consignee" readonly disabled>
                                Dispatch to consignee
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="dispatch_type" @if($shipment->dispatch_type == 'Pickup to consignee') checked="checked" @endif value="Pickup to consignee" readonly disabled>
                                Taken by consignee
                            </label>
                    </div>
                    <div class="form-group">
                        <h5><strong>DELIVERY SHIPMENT</strong></h5>
                        <label>Delivered By :</label>
                        <span class="alert-validation" style="color: red"><br>{{ $errors->first('delivered_by') }}</span>
                        <select name="delivered_by" class="form-control">
                            <option selected></option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if ($user->id == $shipment->delivered_by) selected @endif>{{ $user->first_name.' '.$user->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Delivered Date :</label>
                                    <span class="alert-validation" style="color: red"><br>{{ $errors->first('delivered_date') }}</span>
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                    <input type="text" name="delivered_date" class="form-control pickadate-year" @if($shipment->delivered_date != null) value={{$shipment->delivered_date}} @else placeholder='yyyy-mm-dd' @endif>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Delivered Time :</label>
                                    <span class="alert-validation" style="color: red"><br>{{ $errors->first('delivered_time') }}</span>
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                    <input type="text" name="delivered_time" class="form-control pickatime" @if($shipment->delivered_time != null) value={{$shipment->delivered_time}} @else placeholder='hh:mm:ss' @endif>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Received By :</label>
                                <input class="form-control" type="text" name="receivedby" value="{{$shipment->received_by}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Received Time :</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                    <input type="text" name="received_date" class="form-control pickatime" value="{{$shipment->received_time}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            @if ($shipment->id_shipment_status == 15)
                            <div class="form-group">
                                <label>Received Image:</label><br>
                                <img src="{{asset($shipment->photo_ktp)}}" width="250" style="border: solid 1px #AAA">
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if ($shipment->id_shipment_status == 15)
                            <div class="form-group">
                                <label>Signature Image:</label><br>
                                <img src="{{asset($shipment->photo_signature)}}" width="250" style="border: solid 1px #AAA">
                            </div>
                            @endif 
                        </div>
                    </div>
                    <!-- <div class="tabbable">
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
                                            <input type="text" class="form-control" value="{{$shipment->shipper_first_name.' '.$shipment->shipper_last_name}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Address :</label>
                                            <textarea rows="5" class="form-control" placeholder="Enter shipper address here" name="shipper_address" readonly disabled>{{ $shipment->shipper_address }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Phone :</label>
                                            {{ Form::text('shipper_mobile', $shipment->shipper_mobile_phone, array('class' => 'form-control', 'placeholder' => 'Shipper Mobile Phone', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>E-mail :</label>
                                            {{ Form::email('shipper_email_address', $shipment->shipper_email_address, array('class' => 'form-control', 'placeholder' => 'Shipper E-mail address', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>Latitude :</label>
                                            {{ Form::text('shipper_latitude', $shipment->shipper_latitude, array('class' => 'form-control', 'placeholder' => 'Shipper Latitude', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>Longitude :</label>
                                            {{ Form::text('shipper_longitude', $shipment->shipper_longitude, array('class' => 'form-control', 'placeholder' => 'Shipper Longitude', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <legend class="text-bold">Consignee</legend>
                                        <div class="form-group">
                                            <label>Name :</label>
                                            {{ Form::text('consignee_name', $shipment->consignee_first_name.' '.$shipment->consignee_last_name, array('class' => 'form-control', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>Address :</label>
                                            <textarea rows="5" class="form-control" placeholder="Enter consignee address here" name="consignee_address" readonly disabled>{{ $shipment->consignee_address }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number :</label>
                                            {{ Form::text('consignee_phone', $shipment->consignee_phone_no, array('class' => 'form-control', 'placeholder' => 'Consignee Phone Number', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Phone :</label>
                                            {{ Form::text('consignee_mobile', $shipment->consignee_mobile_phone, array('class' => 'form-control', 'placeholder' => 'Consignee Mobile Phone', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>E-mail :</label>
                                            {{ Form::email('consignee_email_address', $shipment->consignee_email_address, array('class' => 'form-control', 'placeholder' => 'Consignee E-mail address', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
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
                                            {{ Form::text('shipment_content', $shipment->shipment_contents, array('class' => 'form-control', 'placeholder' => 'Shipment Content', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>Estimated Goods Value :</label>
                                            {{ Form::text('estimated_goods_value', $shipment->estimate_goods_value, array('class' => 'form-control', 'placeholder' => 'Estimated Goods Value' ,'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                        <div class="form-group">
                                            <label>Estimated Weight :</label>
                                            {{ Form::number('estimated_weight', $shipment->estimate_weight, array('class' => 'form-control', 'placeholder' => 'Estimated Weight', 'readonly' => 'readonly', 'disabled' => 'disabled')) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <legend class="text-bold">Costs</legend>
                                        <div class="form-group">
                                            <label class="display-block text-semibold">Additional Insurance :</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="additional_insurance" @if($shipment->is_add_insurance == 0) checked="checked" @endif value="0" disabled readonly>
                                                No
                                            </label>

                                            <label class="radio-inline">
                                                <input type="radio" name="additional_insurance" @if($shipment->is_add_insurance == 1) checked="checked" @endif  value="1" disabled readonly>
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
                                        <input type="radio" name="online_payment" @if($shipment->is_online == 0) checked="checked" @endif  value="0" disabled readonly>
                                        No
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" name="online_payment" @if($shipment->is_online == 1) checked="checked" @endif  value="1" disabled readonly>
                                        Yes
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Payment Type :</label>
                                    <input type="text" value="{{$shipment->payment_type}}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Bank Name :</label>
                                    <input type="text" value="{{$shipment->bank_name}}" class="form-control" disabled="">
                                </div>
                                <div class="form-group">
                                    <label>Card Type :</label>
                                    <select name="card_type" class="select-search" id="card" disabled readonly>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Card Number :</label>
                                    {{ Form::number('card_number', $shipment->card_no, array('class' => 'form-control', 'placeholder' => 'Card Number', 'disabled'=> 'disabled')) }}
                                </div>
                                <div class="form-group">
                                    <label>Security Code :</label>
                                    {{ Form::number('security_code', $shipment->card_security_code, array('class' => 'form-control', 'placeholder' => 'Card Security Number', 'disabled'=> 'disabled', 'readonly' => 'readonly')) }}
                                </div>
                                <div class="form-group">
                                    <label>Expired Date :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" name="expired_date" class="form-control pickadate-year" placeholder="Expired date" value="{{ $shipment->card_expired_date }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="notes">
                                <div class="form-group">
                                    <label>Additional Notes :</label>
                                    <textarea rows="10" class="form-control" placeholder="Additional Notes" name="addtional_notes" disabled readonly>{{ $shipment->add_notes }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <ul class="icons-list" style="float: right;">
                        <li>
                            <div class="text-right form-group">
                                <button type="submit" value='save' name='submit' class="btn btn-primary" style="vertical-align: middle;" {{ $shipment->id_shipment_status == 15 ? 'disabled':'' }}><i class="icon-floppy-disk"
                            ></i> Save</button>
                            </div>
                            {{ Form::close() }}
                        </li>
                        <li>
                            <div class="text-right form-group">
                                <button type="submit" value='submit' name='submit' class="btn btn-danger" style="vertical-align: middle;" {{ $shipment->id_shipment_status == 15 ? 'disabled':'' }}>Submit</button>
                            </div>
                        </li>
                    </ul>
                    {{ Form::close() }}
                </div>
            </div> 
        </div>
        <script type="text/javascript">
            $('.pickadate-year').datepicker({
                format: 'yyyy-mm-dd',
                startDate : new Date,
            });

            $('.pickatime').timepicker({
                template : 'dropdown',
                showInputs: false,
                showSeconds: false,
                showMeridian: false
              });
        </script>
        
@endsection