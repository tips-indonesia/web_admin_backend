@extends('admin.app')

@section('title')
    Shipment List
@endsection
@section('page_title')
<span class="text-semibold">Shipment List</span> - Show All
<button type="button" class="btn btn-success" onclick="window.location.href='{{ route('shipments.create') }}'">Create</button>
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
                    <th>Depart Date</th>
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
                            {{ $data->depart_date }}
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
                            {{ Form::open(array('method' => 'DELETE', 'url' => route('shipments.destroy', $data->id))) }}
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