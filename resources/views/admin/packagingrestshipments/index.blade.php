@extends('admin.app')

@section('title')
    Packaging Rest Shipment
@endsection
@section('page_title')
    <span class="text-semibold">Packaging Rest Shipment</span> - Show All
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('packagingrestshipments.create') }}'">Create</button>
@endsection
@section('content')

    <div class="panel panel-flat">
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Package ID</th>
                    <th>Total Shipment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            <a href="{{ route('packagingrestshipments.edit', $data->id) }}">
                                {{ $data->packaging_id }}
                            </a>
                        </td>
                        <td>
                            {{ $data->count }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->links() }}
    </div>

@endsection