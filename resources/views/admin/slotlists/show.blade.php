@extends('admin.app')

@section('title')
    Slot List Detail
@endsection
@section('page_title')
<span class="text-semibold">Slot List</span> - Detail
@endsection
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                	 <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Slot ID :</label>
                                {{ Form::text('slot_id', $data->slot_id, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Slot Date :</label>
                                {{ Form::text('slot_date', $data->slot_date, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-6">
                    		
                            <div class="form-group">
	                            <label class="display-block text-semibold">Domestic Shipment :</label>
	                            <label class="radio-inline">
	                                <input type="radio" name="domestic_shipment" checked="checked" value="0" readonly disabled>
	                                No
	                            </label>

	                            <label class="radio-inline">
	                                <input type="radio" name="domestic_shipment" value="1" readonly disabled>
	                                Yes
	                            </label>
	                        </div>
                    	</div>
                    </div>

                    <div class="row">
                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Origin Airport :</label>
	                            <select name="origin_airport" class="select-search" disabled readonly>
	                                <option value="1" selected>{{ $data->origin_airport }}</option>
	                            </select>
	                        </div>   
                    	</div>

                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Destination Airport :</label>
	                            <select name="destination_airport" class="select-search" disabled readonly>
	                                <option value="1" selected>{{ $data->destination_airport }}</option>
	                            </select>
	                        </div>   
                    	</div>
                    </div>

                    <div class="row">
                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Departure Date :</label>
	                            {{ Form::text('departure_date', $data->depature_date , array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
	                        </div>   
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Departure Time :</label>
	                            {{ Form::text('departure_time', $data->depature_time , array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
	                        </div>   
                    	</div>

                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Arrival Time :</label>
	                            {{ Form::text('arrival_time',  $data->arrival_time , array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
	                        </div>   
                    	</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Quantity Slot :</label>
                                {{ Form::text('Packaging ID', $data->packaging_id, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Quantity Shipment :</label>
                                {{ Form::text('slot_date', $data->slot_date, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>  
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Mile Pickup Date :</label>
                                {{ Form::text('Packaging ID', $data->packaging_id, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>
                            <div class="form-group">
                                <label>Last Mile Pickup Hour :</label>
                                {{ Form::text('slot_date', $data->slot_date, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Mile Pickup Name :</label>
                                {{ Form::text('slot_date', $data->slot_date, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>  
                        </div> 
                    </div>
                    <div class="form-group">
                        <label>Status :</label>
                        {{ Form::text('slot_date', $data->slot_date, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                    </div>  
                    <legend class="text-bold">TIPSter</legend>
                    <div class="row">
                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Name :</label>
	                            {{ Form::text('name',  $data->member->name , array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
	                        </div>   
                    	</div>

                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Phone Number :</label>
	                            {{ Form::text('phone_number', $data->member->phone_no , array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
	                        </div>   
                    	</div>
                    </div> 
                    <div class="row">
                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Address :</label>
	                            <textarea rows="5" class="form-control" placeholder="Address" name="shipper_address" readonly disabled>{{ $data->member->address }}</textarea>
	                        </div>   
                    	</div>

                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Mobile Phone:</label>
	                            {{ Form::text('phone_number', $data->member->mobile_phone, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
	                        </div>   
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-md-6">
		                    <div class="form-group">
		                        <label>E-mail :</label>
		                        {{ Form::text('email', $data->member->email_address, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
		                    </div>  
		                </div>
		            </div>
                    <div class="row">
                        <div class="col-md-6">
                        <legend class="text-bold">Transactional Detail</legend>
                            <div class="form-group">
                                <label>Packaging ID :</label>
                                {{ Form::text('Packaging ID', null, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>
                            <div class="form-group">
                                <label>Packaging Date :</label>
                                {{ Form::text('slot_date', null, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>  
                            <div class="form-group">
                                <label>Packaging Size :</label>
                                {{ Form::text('slot_date', null, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>  
                        </div>
                        <div class="col-md-6">
                        <legend class="text-bold">Distribution Data</legend>
                            <div class="form-group">
                                <label>Date :</label>
                                {{ Form::text('Packaging ID', null, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>
                            <div class="form-group">
                                <label class="display-block text-semibold">Dispatch Type :</label>
                                <label class="radio-inline">
                                    <input type="radio" name="domestic_shipment" checked="checked" value="0" readonly disabled>
                                    Dispatch to Last Mile
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="domestic_shipment" value="1" readonly disabled>
                                    Pickup at Drop Point
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Dispatch Hour :</label>
                                {{ Form::text('slot_date', $data->slot_date, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>
                            <div class="form-group">
                                <label class="display-block text-semibold">Dispatch By :</label>
                                <label class="radio-inline">
                                    <input type="radio" name="domestic_shipment" checked="checked" value="0" readonly disabled>
                                    Team Logistics
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="domestic_shipment" value="1" readonly disabled>
                                    Others
                                </label>
                            </div>  
                        </div>
                    </div>    
                </div>
            </div>
        </div>
        <script type="text/javascript">
        	$('.select-search').select2();
        </script>
    </div>
@endsection