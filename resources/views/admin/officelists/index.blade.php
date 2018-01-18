 @extends('admin.app')

@section('title')
    Office List
@endsection
@section('page_title')
    <span class="text-semibold">Office List</span> - Show All
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('officelists.create') }}'">Create</button>
@endsection
@section('content')

    <div class="panel panel-flat">
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Office Name</th>
                    <th>Office Type</th>
                    <th>Airport List</th>
                    <th>Status</th>
                    <th>Details</th>
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
                            {{ $data->office_type_name }}
                        </td>
                        <td>
                            @if ($data->id_office_type == $processing_center->id)
                        <button type="button" class="btn btn-default btn-sm" onclick="window.location.href='{{ route('officeairports.show', $data->id) }}'">Airport Lists</button>
                            @endif
                        </td>
                        <td>
                            {{ $data->status ? 'Active' : 'Inactive' }}
                        </td>
                        <td>
                            @if ($data->id_office_type == $processing_center->id)
                        <button type="button" class="btn btn-default btn-sm" onclick="window.location.href='{{ route('officedroppoints.show', $data->id) }}'">Drop Point Lists</button>
                            @endif
                            
                        </td>
                        <td>
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'GET', 'url' => route('officelists.edit', $data->id))) }}
                        <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                        {{ Form::close() }}
                            </li>
                            <li>
                            {{ Form::open(array('method' => 'DELETE', 'url' => route('officelists.destroy', $data->id))) }}
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