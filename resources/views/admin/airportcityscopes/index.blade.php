@extends('admin.app')

@section('title')
    City Scope List
@endsection
@section('page_title')
<span class="text-semibold">City Scope List</span> - {{ $airport->name }}
<button type="button" class="btn btn-success" onclick="window.location.href='{{ route('airportcityscopes.create', $airport->id) }}'">Create</button>
@endsection
@section('content')
    <div class="panel panel-flat">
        

        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
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
                            {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                        </td>
                        <td>
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'GET', 'url' => route('airportcityscopes.edit', [$airport->id,$data->id] ))) }}
                        <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                        {{ Form::close() }}
                            </li>
                            <li>
                            {{ Form::open(array('method' => 'DELETE', 'url' => route('airportcityscopes.destroy',  [$airport->id, $data->id]))) }}
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