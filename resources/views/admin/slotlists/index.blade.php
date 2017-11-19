@extends('admin.app')

@section('title')
    Slot List
@endsection
@section('page_title')
<span class="text-semibold">Slot List</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        

        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Slot ID</th>
                    <th>TIPSTER Name</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Depart Date</th>
                    <th>Depart Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            <a href="{{ route('slotlists.show', $data->id) }}">
                            {{ $data->slot_id }}
                            </a>
                        </td>
                        <td>
                            {{ $data->member_name }}
                        </td>
                        <td>
                            {{ $data->origin_airport }}
                        </td>
                        <td>
                            {{ $data->destination_airport }}
                        </td>
                        <td>
                            {{ $data->departure_date }}
                        </td>
                        <td>
                            {{ $data->departure_time }}
                        </td>
                        <td>
                            {{ $data->status }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->links() }}
    </div>

@endsection