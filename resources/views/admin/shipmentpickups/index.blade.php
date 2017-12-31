@extends('admin.app')

@section('title')
    Shipment List
@endsection
@section('page_title')
<span class="text-semibold">Shipment List</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        

        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Shipment ID</th>
                    <th>Shipper Name</th>
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
                            {{ $data->shipper_name }}
                        </td>
                        <td>
                            {{ $data->name_origin }}
                        </td>
                        <td>
                            {{ $data->name_destination }}
                        </td>
                        <td>
                            {{ $data->pickup_by }}
                        </td>
                        <td>
                            {{ $data->pickup_status }}
                        </td>
                        <td>
                            {{ $data->is_posted ==1 ? 'Submitted' : 'Not Submitted' }}
                        </td>
                        <td>
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'DELETE', 'url' => route('shipmentpickups.destroy', $data->id))) }}
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

@endsection