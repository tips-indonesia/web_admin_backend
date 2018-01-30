@extends('admin.app')

@section('title')
    User List
@endsection
@section('page_title')
    <span class="text-semibold">User List</span> - Show All
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('users.create') }}'">Create</button>
@endsection
@section('content')
    <div class="panel panel-flat">
        <table style="display:nonea" class="table datatable-pagination" border="1">
            <thead>
                <tr>
                    <th>Step</th>
                    <th>Shipment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $i => $data)
                    <tr>
                        <td><h1>{{$i}}</h1></td>
                        <td>
                            <table border="1">
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{$d->shipment_id}}</td>
                                    <td>{{$d->slotList ? $d->slotList->id_slot_status." ".$d->slotList : "-"}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection