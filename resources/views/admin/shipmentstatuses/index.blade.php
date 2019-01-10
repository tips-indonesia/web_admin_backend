@extends('admin.app')

@section('title')
    Shipment Status
@endsection
@section('page_title')
<span class="text-semibold">Shipment Status</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Step</th>
                    <th>Bahasa Indonesia</th>
                    <th>English</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            {{ $data->step }}
                        </td>
                        <td>
                            {{ $data->description }}
                        </td>
                        <td>
                            {{ $data->description_en }}
                        </td>
                        <td>
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'GET', 'url' => route('shipmentstatuses.edit', $data->id))) }}
                        <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
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