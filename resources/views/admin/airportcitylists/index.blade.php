@extends('admin.app')

@section('title')
    Airportcity List
@endsection
@section('page_title')
    <span class="text-semibold">Airportcity List</span> - Show All
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('airportcitylists.create') }}'">Create</button>
@endsection
@section('content')
    <div class="panel panel-flat">     

        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            {{ $data->name }}
                        </td>
                        <td>
                        <ul class="icons-list">
                        <li>
                        {{ Form::open(array('method' => 'GET', 'url' => route('airportcitylists.edit', $data->id))) }}
                        <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                        {{ Form::close() }}
                        </li>
                        <li>
                        {{ Form::open(array('method' => 'DELETE', 'url' => route('airportcitylists.destroy', $data->id))) }}
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