@extends('admin.app')

@section('title')
    Status Changer
@endsection
@section('page_title')
    <span class="text-semibold">Status Changer</span> - Show All
@endsection
@section('content')

    <div class="panel panel-flat">
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Shipment ID</th>
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
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'PUT', 'url' => route('statuschangers.update', $data->id))) }}
                                <div class="form-group">
                                    <select name="shipment_status" class="select-search">
                                        <option disabled selected></option>
                                        @foreach ($shipment_statuses as $shipment_status)
                                            <option value="{{ $shipment_status->id }}" @if($data->id_shipment_status == $shipment_status->id) selected @endif>{{ $shipment_status->description }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Update</button>
                                </div>
                            {{ Form::close() }}
                            </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->appends(request()->input())->links() }}
    </div>

@endsection