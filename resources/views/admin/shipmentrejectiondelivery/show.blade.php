@extends('admin.app')

@section('title')
    Shipment Rejection Delivery
@endsection
@section('page_title')
    <span class="text-semibold">Shipment Rejection Delivery</span> - Detail
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
                    {{ Form::open(array('method' => 'PUT', 'url' => route('shipmentrejectiondelivery.update', $shipment->id))) }}
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
                    <ul class="icons-list" style="float: right;">
                        <li>
                            <div class="text-right form-group">
                                <button type="submit" value='save' name='submit' class="btn btn-primary" style="vertical-align: middle;" {{ $shipment->id_shipment_status == -2 ? 'disabled':'' }}><i class="icon-floppy-disk"
                            ></i> Save</button>
                            </div>
                            {{ Form::close() }}
                        </li>
                        <li>
                            <div class="text-right form-group">
                                <button type="submit" value='submit' name='submit' class="btn btn-danger" style="vertical-align: middle;" {{ $shipment->id_shipment_status == -2 ? 'disabled':'' }}>Submit</button>
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