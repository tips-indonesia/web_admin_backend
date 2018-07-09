@extends('admin.app')

@section('title')
    Weight List
@endsection
@section('page_title')
    <span class="text-semibold">Weight List</span> - Show All
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('weightlists.create') }}'">Create</button>
@endsection
@section('content')
    <div class="panel panel-flat">     

        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Weight (Kg)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            {{ $data->weight_kg }}
                        </td>
                        <td>
                            {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                        </td>
                        <td>
                        <ul class="icons-list">
                        <li>
                        {{ Form::open(array('method' => 'GET', 'url' => route('weightlists.edit', $data->id))) }}
                        <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                        {{ Form::close() }}
                        </li>
                        <li>
                        {{ Form::open(array('method' => 'DELETE', 'url' => route('weightlists.destroy', $data->id))) }}
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