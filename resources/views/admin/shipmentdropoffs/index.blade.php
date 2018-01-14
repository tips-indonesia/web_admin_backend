@extends('admin.app')

@section('title')
    Shipment List
@endsection
@section('page_title')
<span class="text-semibold">Shipment List</span> - Show All
<button type="button" class="btn btn-success" onclick="window.location.href='{{ route('shipmentdropoffs.create') }}?registration_type={{$registration_type}}'"
@if ($registration_type == 'online') disabled @endif>Create</button>

@endsection
@section('content')
    <div class="panel panel-flat">
        {{ Form::open(array('url' => route('shipmentdropoffs.index'), 'method' => 'GET')) }}
                <div class="panel-body">
                    <div class="form-group">
                    <label>Date :</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                        <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Transaction date" value={{$date}}>
                    </div>
                </div>
                <div class="form-group">
                    <label class="display-block text-semibold">Shipment Type :</label>
                    <label class="radio-inline">
                        <input type="radio" name="registration_type" value="online" {{ $registration_type == 'online' ? 'checked' : '' }}>
                        Online
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="registration_type"  value="offline" {{ $registration_type == 'offline' ? 'checked' : '' }}>
                        Offline
                    </label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Search By :</label>
                            <select name="param" id="param" class="select-search">
                                <option value="blank" selected>&#8192;</option>
                                <option value="shipment_id" >Shipment ID</option>
                                <option value="shipper_name" >Shipper Name</option>
                                <option value="pickup_status" >Pickup Status</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>&#8192;</label>
                            <input type="text" name="value" id="value" class="form-control " placeholder="Search" >                       
                        </div>
                    </div>
                </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">View <i class="icon-arrow-right14  position-right"></i></button>
                        </div>
                </div>
        {{ Form::close() }}

        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Shipment ID</th>
                    <th>Shipper Name</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Goods Status</th>
                    <th>Status</th>
                    <th>Submit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            @if ($data->is_posted == 0)
                                <a href="{{ route('shipments.edit', $data->id) }}">
                                {{ $data->shipment_id }}
                                </a>
                            @else
                                <a href="{{ route('shipments.show', $data->id) }}">
                                {{ $data->shipment_id }}
                                </a>
                            @endif
                        </td>
                        <td>
                            {{ $data->shipper_name }}
                        </td>
                        <td>
                            {{ $data->name_origin }}
                        </td>
                        <td>
                            {{ $data->name_destination }}
                        </td>
                        <td>
                            {{ $data->goods_status }}
                        </td>
                        <td>
                            {{ $data->status }}
                        </td>
                        <td>
                            {{ $data->is_posted ==1 ? 'Submitted' : 'Not Submitted' }}
                        </td>
                        <td>
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'DELETE', 'url' => route('shipmentdropoffs.destroy', $data->id))) }}
                            <button type="submit" class="btn btn-danger"><i class="icon-trash"></i> Cancel</button>
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
    </script>

@endsection