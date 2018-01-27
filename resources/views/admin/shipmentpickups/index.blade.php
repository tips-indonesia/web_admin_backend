@extends('admin.app')

@section('title')
    Shipment Pickup List
@endsection
@section('page_title')
<span class="text-semibold">Shipment Pickup List</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        
        {{ Form::open(array('url' => route('shipmentpickups.index'), 'method' => 'GET', 'id' => 'date_form')) }}
                    <div class="panel-body">
                <div class="form-group">
                    <label>Date :</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                        <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Transaction date" value="{{ $date }}">
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Search By :</label>
                        <select name="param" id="param" class="select-search">
                            <option value="blank" selected>&#8192;</option>
                            <option value="shipment_id" {{ $param == 'shipment_id' ? 'selected' : '' }}>Shipment ID</option>
                            <option value="shipper_name" {{ $param == 'shipper_name' ? 'selected' : '' }}>Shipper Name</option>
                            <option value="pickup_status" {{ $param == 'pickup_status' ? 'selected' : '' }}>Pickup Status</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>&#8192;</label>
                        <input type="text" name="value" id="value" class="form-control " placeholder="Search" value="{{$value}}">                       
                    </div>
                </div>
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
                    <th>Pickup By</th>
                    <th>Pickup Status</th>
                    <th>Submit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            @if ($data->is_posted == 0)
                                <a href="{{ route('shipmentpickups.edit', $data->id) }}">
                                {{ $data->shipment_id }}
                                </a>
                            @else
                                <a href="{{ route('shipmentpickups.show', $data->id) }}">
                                {{ $data->shipment_id }}
                                </a>
                            @endif
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
                            @if($data->pickup_by_user != null) {{ $data->pickup_by_user->first_name }} {{ $data->pickup_by_user->last_name }} @endif
                        </td>
                        <td>
                            @if ($data->id_shipment_status >= 3)
                                Done
                            @else
                                Pending
                            @endif
                        </td>
                        <td>
                            {{ $data->is_posted ==1 ? 'Submitted' : 'Not Submitted' }}
                        </td>
                        <td>
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'DELETE', 'url' => route('shipmentpickups.destroy', $data->id))) }}
                            <button type="submit" class="btn btn-danger" @if ($data->is_posted) DISABLED @endif><i class="icon-trash"></i> Cancel</button>
                            {{ Form::close() }}
                            </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->links() }}
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