@extends('admin.app')

@section('title')
    Country List
@endsection
@section('module')
    Country List
@endsection
@section('operation')
    Show All
@endsection
@section('create_button')
    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="{{ route('countrylists.create') }}" class="btn btn-success btn-float ">Create new</a>
        </div>
    </div>
@endsection('create_button')
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
                            {{ Form::open(array('method' => 'GET', 'url' => route('countrylists.edit', $data->id))) }}
                        <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                        {{ Form::close() }}
                            </li>
                            <li>
                            {{ Form::open(array('method' => 'DELETE', 'url' => route('countrylists.destroy', $data->id))) }}
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