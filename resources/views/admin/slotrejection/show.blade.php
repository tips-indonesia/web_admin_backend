@extends('admin.app')

@section('title')
    Slot Rejection Detail
@endsection
@section('page_title')
<span class="text-semibold">Slot Rejection</span> - Detail
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
                                {{ Form::text('slot_date', $data->created_at, array('class' => 'form-control', 'placeholder' => 'Slot Date', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Airlines Name :</label>
                                {{ Form::text('airlines_name', $data->airline_data->name, array('class' => 'form-control', 'placeholder' => 'Airlines Name', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Flight Code :</label>
                                {{ Form::text('flight_code', $data->flight_code, array('class' => 'form-control', 'placeholder' => 'Flight Code', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
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
	                            {{ Form::text('departure_date', explode(' ', $data->depature)[0] , array('class' => 'form-control', 'placeholder' => 'Departure Date', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
	                        </div>   
                    	</div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Departure Time :</label>
                                {{ Form::text('departure_date', explode(' ', $data->depature)[1] , array('class' => 'form-control', 'placeholder' => 'Departure Time', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>   
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Quantity Slot :</label>
                                {{ Form::text('Packaging ID', $data->baggage_space, array('class' => 'form-control', 'placeholder' => 'Quantity Slot', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Quantity Shipment :</label>
                                {{ Form::text('slot_date', $data->sold_baggage_space, array('class' => 'form-control', 'placeholder' => 'Quantity Shipment', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>  
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label>Status :</label>
                        {{ Form::text('slot_date', $data->status, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                    </div>  
                    <legend class="text-bold">TIPSter</legend>
                    <div class="row">
                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Name :</label>
	                            {{ Form::text('name',  $member->first_name.' '.$member->last_name , array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
	                        </div>   
                    	</div>

                    	<div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile Phone:</label>
                                {{ Form::text('phone_number', $member->mobile_phone_no, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
                            </div>   
                        </div>
                    </div> 
                    <div class="row">
                    	<div class="col-md-6">
                            <div class="form-group">
	                            <label>Address :</label>
	                            <textarea rows="5" class="form-control" placeholder="Address" name="shipper_address" readonly disabled>{{ $member->address }}</textarea>
	                        </div>   
                    	</div>

                    	
                    </div>
                    <div class="row">
                    	<div class="col-md-6">
		                    <div class="form-group">
		                        <label>E-mail :</label>
		                        {{ Form::text('email', $member->email, array('class' => 'form-control', 'placeholder' => 'Slot ID', 'readonly' => 'readonly', 'disabled' => 'disabled' )) }}
		                    </div>  
		                </div>
		            </div>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_small">Shipment List</i></button>
                        </div>
                        <div class="col-md-2">
                            {{ Form::open(array('method' => 'PUT', 'url' => route('slotrejection.update', $data->id))) }}
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger" {{ ($data->id_slot_status > -1) ? '' : 'disabled' }}>Reject</button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal_small" class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="width: 550px" id="qrcodex">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Shipment List</h5>
                    </div>

                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Shipment id </th>
                                    <th>Keterangan Barang </th>
                                    <th>Real Weight </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($shipments as $shipment)
                                <tr>
                                    <td>{{ $shipment->shipment_id }}</td>
                                    <td>{{ $shipment->shipment_contents }} </td>
                                    <td>{{ $shipment->real_weight}} kg</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        	$('.select-search').select2();
        </script>
    </div>
@endsection