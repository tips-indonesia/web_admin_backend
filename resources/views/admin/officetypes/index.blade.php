@extends('admin.app')

@section('title')
    Office Type List
@endsection
@section('page_title')
    <span class="text-semibold">Office Type List</span> - Show All
@endsection
@section('content')

    <div class="panel panel-flat">
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            {{ $data->name }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->appends(request()->input())->links() }}
    </div>

@endsection