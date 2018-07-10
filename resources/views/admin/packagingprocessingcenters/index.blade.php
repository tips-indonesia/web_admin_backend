@extends('admin.app')

@section('title')
    Processing Center Packaging List
@endsection
@section('page_title')
    <span class="text-semibold">Processing Center Packaging List</span> - Show All
@endsection
@section('content')

    <div class="panel panel-flat">
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Package ID</th>
                    <th>Slot Package</th>
                    <th>Delivery Status</th>
                    <th>Receive Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            {{ $data->packaging_id }}
                        </td>
                        <td>
                            {{ $data->slot_id }}
                        </td>
                        <td>
                            {{ $data->name }}
                        </td>
                        <td>
                            {{ $data->name }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->appends(request()->input())->links() }}
    </div>

@endsection