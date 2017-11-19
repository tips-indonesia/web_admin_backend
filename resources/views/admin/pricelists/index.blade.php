@extends('admin.app')

@section('title')
    Price List
@endsection
@section('page_title')
    <span class="text-semibold">Price List</span> - Show All
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('pricelists.create') }}'">Create</button>
@endsection
@section('content')

    <div class="panel panel-flat">
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Origin City Name</th>
                    <th>Destination City Name</th>
                    <th>Tipster / Kg</th>
                    <th>Freight Cost / Kg</th>
                    <th>Add First Class / Kg</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            {{ $data->origin_name }}
                        </td>
                        <td>
                            {{ $data->dest_name }}
                        </td>
                        <td>
                            {{ $data->tipster_price }}
                        </td>
                        <td>
                            {{ $data->freight_cost }}
                        </td>
                        <td>
                            {{ $data->add_first_class }}
                        </td>
                        <td>
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'GET', 'url' => route('pricelists.edit', $data->id))) }}
                        <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                        {{ Form::close() }}
                            </li>
                            <li>
                            {{ Form::open(array('method' => 'DELETE', 'url' => route('pricelists.destroy', $data->id))) }}
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