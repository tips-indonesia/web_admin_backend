@extends('admin.app')

@section('title')
    Shipment Matching Monitoring
@endsection
@section('page_title')
<span class="text-semibold">Shipment Matching Monitoring</span> - Show All
<button type="button" class="btn btn-success" onclick="window.location.href='{{ route('shipmentmatchingmonitors.create') }}'">Create</button>
@endsection
@section('content')
    <div class="panel panel-flat">
            {{ Form::open(array('url' => route('shipmentmatchingmonitors.index'), 'method' => 'GET')) }}
            <div class="panel-body">
            <div class="form-group">
                <label class="display-block text-semibold">Shipment Type :</label>
                <label class="radio-inline">
                    <input type="radio" name="match" value="all" @if(!$match || $match == 'all') checked @endif>
                    All
                </label>
                <label class="radio-inline">
                    <input type="radio" name="match"  value="Pickup" @if($match == 'Pickup') checked @endif>
                    Pickup
                </label>
                <label class="radio-inline">
                    <input type="radio" name="match"  value="Online" @if($match == 'Online') checked @endif>
                    Online
                </label>
                <label class="radio-inline">
                    <input type="radio" name="match"  value="Offline" @if($match == 'Offline') checked @endif>
                    Offline
                </label>
            </div>
            <div class="form-group">
                <label class="display-block text-semibold">Class Type :</label>
                <label class="radio-inline">
                    <input type="radio" name="class" value="all" @if(!$class || $class == 'all') checked @endif>
                    All
                </label>
                <label class="radio-inline">
                    <input type="radio" name="class"  value="regular" @if($class == 'regular') checked @endif>
                    Regular
                </label>
                <label class="radio-inline">
                    <input type="radio" name="class"  value="first_class" @if($class == 'first_class') checked @endif>
                    First Class
                </label>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Search By :</label>
                        <select name="param" class="select-search">
                            <option value="blank" selected>&#8192;</option>
                            <option value="shipment_id" {{ $param == 'shipment_id' ? 'selected' : '' }}>Shipment ID</option>
                            <option value="shipper_name" {{ $param == 'shipper_name' ? 'selected' : '' }}>Shipper Name</option>
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
                    <th>Registration Type</th>
                    <th>Class Type</th>
                    <th>Goods Status</th>
                    <th>Submit</th>
                    <th>Slot ID</th>
                    <th>Drop Point</th>
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
                            {{ $data->registration_type }}
                        </td>
                        <td>
                            {{ $data->is_first_class ? 'First Class' : 'Regular' }}
                        </td>
                        <td>
                            {{ $data->goods_status }}
                        </td>
                        <td>
                            {{ $data->is_posted ==1 ? 'Submitted' : 'Not Submitted' }}
                        </td>
                        <td>
                            {{ $data->slot_id }}
                        </td>
                        <td>
                            ?
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->links() }}
    </div>
        <script>
        $('.select-search').select2();
        $('#param').on('select2:select', function() {
            $('#value').removeAttr('disabled');
        });
        $('#param').on('select2:select', function() {
            if ($('#param').val() != 'blank') {
                $('#value').prop('required', true)
            } else {
                $('#value').prop('required', false)
            }
        });
    </script>

@endsection