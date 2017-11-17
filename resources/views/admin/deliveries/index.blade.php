@extends('admin.app')

@section('title')
    Delivery to Processing Center
@endsection
@section('page_title')
    <span class="text-semibold">Delivery to Processing Center</span> - Show All
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('deliveries.create') }}'">Create</button>
@endsection
@section('content')
    <div class="panel panel-flat">     

        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Delivery ID</th>
                    <th>Total Shipment</th>
                    <th>Submit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            <a href="{{ route('deliveries.edit', $data->id) }}">
                            {{ $data->delivery_id }}
                            </a>
                        </td>
                        <td>
                            {{ $data->total }}
                        </td>
                        <td>
                        <ul class="icons-list">
                        
                        <li>
                            {{ $data->is_posted == 1 ? 'Submited' : 'Not Submited' }}
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