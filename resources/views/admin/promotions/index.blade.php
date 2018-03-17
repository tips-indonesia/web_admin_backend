@extends('admin.app')

@section('title')
    Promotion
@endsection
@section('page_title')
<span class="text-semibold">Promotion</span> - Show All
<button type="button" class="btn btn-success" onclick="window.location.href='{{ route('promotions.create') }}'">Create</button>
@endsection
@section('content')
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>                        
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>                        
                        <td>
                        </td>
                    </tr>
            </tbody>
        </table>

    </div>
    <!-- Small modal -->

@endsection