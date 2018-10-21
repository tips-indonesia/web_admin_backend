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
                    <th>Name</th>
                    <th>Initial Code</th>
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
                            {{ $data->initial_code }}
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

{{ $datas->appends(request()->input())->links() }}
    </div>

@endsection