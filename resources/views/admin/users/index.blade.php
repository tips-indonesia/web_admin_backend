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
    <div class="panel-body">
        <div class="row">
            {{ Form::open(array('url' => route('users.index'), 'method' => 'GET')) }}
            <div class="col-md-6">
                <input type="text" name="firstname" class="form-control" placeholder="First Name" @if(isset($firstname)) value="{{$firstname}} @endif">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary"> Search </button>
            </div>
            {{ Form::close() }}
        </div>

        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            {{ $data->first_name }}
                        </td>
                        <td>
                            {{ $data->last_name }}
                        </td>
                        <td>
                        <ul class="icons-list">
                        <li>
                        {{ Form::open(array('method' => 'GET', 'url' => route('users.edit', $data->id))) }}
                        <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                        {{ Form::close() }}
                        </li>
                        @if (Auth::user()->id != $data->id)
                        <li>
                        {{ Form::open(array('method' => 'DELETE', 'url' => route('users.destroy', $data->id))) }}
                        <button type="submit" class="btn btn-danger"><i class="icon-trash"></i> Delete</button>
                        {{ Form::close() }}
                        @endif
                        </li>
                        </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->appends(request()->input())->links() }}
    </div>
</div>

@endsection