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
                            {{ $data->name }}
                        </td>
                        <td>
                            {{ $data->name }}
                        </td>
                        <td>
                        <ul class="icons-list">
                        
                        <li>
                        {{ Form::open(array('method' => 'DELETE', 'url' => route('deliveries.destroy', $data->id))) }}
                        <button type="submit" class="btn btn-danger"><i class="icon-trash"></i> Delete</button>
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