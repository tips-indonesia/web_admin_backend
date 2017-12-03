@extends('admin.app')

@section('title')
    Packaging Slot
@endsection
@section('page_title')
<span class="text-semibold">Packaging Slot</span> - Show All
<button type="button" class="btn btn-success" onclick="window.location.href='{{ route('packagingslots.create') }}'">Create</button>
@endsection
@section('content')
    <div class="panel panel-flat">
        

        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Packaging ID</th>
                    <th>Slot Id</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            <a href="{{ route('packagingslots.edit', $data->id) }}">
                                {{ $data->packaging_id }}
                            </a>
                        </td>
                        <td>
                            {{ $data->slot_id }}
                        </td>                        
                        <td>
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'DELETE', 'url' => route('packagingslots.destroy', $data->id))) }}
                            <button type="submit" class="btn btn-danger"><i class="icon-trash"></i> Cancel</button>
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