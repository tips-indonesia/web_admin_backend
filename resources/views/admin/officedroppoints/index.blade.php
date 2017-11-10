@extends('admin.app')

@section('title')
    Office Drop Point
@endsection
@section('page_title')
<span class="text-semibold">Office Drop Point</span> - {{ $office->name }}
<button type="button" class="btn btn-success" onclick="window.location.href='{{ route('officedroppoints.create', $office->id) }}'">Create</button>
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
                            {{ Form::open(array('method' => 'GET', 'url' => route('officedroppoints.edit', [$office->id,$data->id] ))) }}
                        <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                        {{ Form::close() }}
                            </li>
                            <li>
                            {{ Form::open(array('method' => 'DELETE', 'url' => route('officedroppoints.destroy',  [$office->id, $data->id]))) }}
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