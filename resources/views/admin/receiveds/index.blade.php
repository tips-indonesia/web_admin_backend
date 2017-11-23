@extends('admin.app')

@section('title')
    Received by Processing Center
@endsection
@section('page_title')
    <span class="text-semibold">Received by Processing Center</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Shipment ID</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            {{ $data->shipment_id }}
                        </td>
                        <td>
                            {{ $data->status_name }}
                        </td>
                        <td>
                            @if ($data->id_shipment_status == 3)
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'PUT', 'url' => route('receiveds.update', $data->id))) }}
                            <div class="text-right form-group">
                                <input type="checkbox" name="checked" >
                                <button type="submit"  class="btn btn-danger" style="vertical-align: middle;"><i class="icon-trash"></i> Received</button>
                            </div>
                            {{ Form::close() }}
                            </li>
                            </ul>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->links() }}
    </div>

@endsection