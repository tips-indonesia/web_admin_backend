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
                                    
                                </li>
                                <li>
                                    
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