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
                                {{ Form::text('slot_id', 'xx', array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Slot Date :</label>
                                {{ Form::text('slot_date', 'date', array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-6">
                    		
                            <div class="form-group">
	                            <label class="display-block text-semibold">Domestic Shipment :</label>
	                            <label class="radio-inline">
	                                <input type="radio" name="domestic_shipment" checked="checked" value="0">
	                                No
	                            </label>

	                            <label class="radio-inline">
	                                <input type="radio" name="domestic_shipment" value="1">
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
	                                <option value="1" selected>X</option>
	                            </select>
	                        </div>   
                    	</div>

                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Destination Airport :</label>
	                            <select name="destination_airport" class="select-search" disabled readonly>
	                                <option value="1" selected>X</option>
	                            </select>
	                        </div>   
                    	</div>
                    </div>

                    <div class="row">
                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Departure Date :</label>
	                            {{ Form::text('departure_date', 'date', array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
	                        </div>   
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Departure Time :</label>
	                            {{ Form::text('departure_time', 'date', array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
	                        </div>   
                    	</div>

                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Arrival Time :</label>
	                            {{ Form::text('arrival_time', 'date', array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
	                        </div>   
                    	</div>
                    </div> 
                    <legend class="text-bold">TIPSter</legend>
                    <div class="row">
                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Name :</label>
	                            {{ Form::text('name', 'name', array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
	                        </div>   
                    	</div>

                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Phone Number :</label>
	                            {{ Form::text('phone_number', 'phone', array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
	                        </div>   
                    	</div>
                    </div> 
                    <div class="row">
                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Address :</label>
	                            <textarea rows="5" class="form-control" placeholder="Address" name="shipper_address" readonly disabled></textarea>
	                        </div>   
                    	</div>

                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Mobile Phone:</label>
	                            {{ Form::text('phone_number', 'phone', array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
	                        </div>   
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-md-6">
		                    <div class="form-group">
		                        <label>E-mail :</label>
		                        {{ Form::text('email', 'email@email.com', array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
		                    </div>  
		                </div>
		            </div>
                    <legend class="text-bold">Transactional Detail</legend>    
                </div>
            </div>
        </div>
        <script type="text/javascript">
        	$('.select-search').select2();
        </script>
    </div>
@endsection