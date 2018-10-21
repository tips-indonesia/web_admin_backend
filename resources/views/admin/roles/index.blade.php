@extends('admin.app')

@section('title')
    Role List
@endsection
@section('page_title')
    <span class="text-semibold">Role List</span> - Show All
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('roles.create') }}'">Create</button>
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
                        {{ Form::open(array('method' => 'GET', 'url' => route('roles.edit', $data->id))) }}
                        <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                        {{ Form::close() }}
                        </li>
                        <li>
                        {{ Form::open(array('method' => 'DELETE', 'url' => route('roles.destroy', $data->id))) }}
                        <button type="submit" class="btn btn-danger"><i class="icon-trash"></i> Delete</button>
                        {{ Form::close() }}
                        </li>
                        @if (Auth::user()->hasPermissionTo('permissions.'))
                        <li>
                            <button type="button" class="btn btn-default btn-sm" onclick="window.location.href='{{ route('permissions.edit', $data->id) }}'">Manage Permissions</button>
                        </li>
                        @endif
                        </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->appends(request()->input())->links() }}
    </div>

@endsection