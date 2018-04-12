@extends('admin.app')

@section('title')
    Shipment Cancellation
@endsection

@section('page_title')
<span class="text-semibold">Shipment Cancellation</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        
        {{ Form::open(array('url' => route('shipmentcancellation.index'), 'method' => 'GET', 'id' => 'date_form')) }}
                    <div class="panel-body">
                <div class="form-group">
                    <label>Date :</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                        <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Transaction date" value="{{ $date }}">
                    </div>
                </div>
                <div class="row">
                
            </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">View <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
            {{ Form::close() }}
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Shipment ID</th>
                    <th>Shipper First Name</th>
                    <th>Shipper Last Name</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                	<td>
                        <a href="{{ route('shipmentcancellation.show', $data->id) }}">
                        {{ $data->shipment_id }}
                        </a>
                    </td>
                    <td>
                        {{ $data->shipper_first_name }}
                    </td>
                    <td>
                        {{ $data->shipper_last_name }}
                    </td>
                    <td>
                        {{ $data->name_origin }}
                    </td>
                    <td>
                        {{ $data->name_destination }}
                    </td>
                    <td>
                    	@if($data->id_shipment_status == 0)
                    	Cancelled
                    	@else
                    	Active
                    	@endif
                    </td>
                @endforeach
            </tbody>
        </table>

    </div>
        <script>
            $('.select-search').select2();
            $('.pickadate-year').datepicker({format: 'yyyy-mm-dd',});
            $('#param').on('select2:select', function() {
                if ($('#param').val() == 'pickup_status') {
                    $('#value').val('pending');
                    $('#value').prop('readonly', 'readonly');
                } else {
                    $('#value').val('');
                    $('#value').removeAttr('readonly');
                }
                if ($('#param').val() != 'blank') {
                    $('#value').prop('required', true)
                } else {
                    $('#value').prop('required', false)
                }
        
            })
            if ($('#param').val() == 'pickup_status') {
                $('#value').val('pending');
                $('#value').prop('readonly', 'readonly');
            } else {
                $('#value').val('');
                $('#value').removeAttr('readonly');
            }
            if ($('#param').val() != 'blank') {
                $('#value').prop('required', true)
            } else {
                $('#value').prop('required', false)
            }

        </script>

@endsection