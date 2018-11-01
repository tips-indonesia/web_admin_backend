@extends('admin.app')

@section('title')
    Member List
@endsection
@section('page_title')
    <span class="text-semibold">Member List</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">     
    {{ Form::open(array('url' => route('memberlists.index'), 'method' => 'GET', 'id' => 'member_list_form')) }}
        <div class="col-md-12">
            <div class="form-group">
                <label> First Name </label>
                <div class="row">
                    <div class="col-md-5">
                        <input type="hidden" name="param" value="first_name" />
                        <input type="text" required placeholder="First Name" name="value" class="form-control" />
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"> Search </button>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>E-mail</th>
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
                            {{ $data->email }}
                        </td>
                        <td>
                        <ul class="icons-list">
                        <li>
                        {{ Form::open(array('method' => 'GET', 'url' => route('memberlists.show', $data->id))) }}
                        <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Details</button>
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