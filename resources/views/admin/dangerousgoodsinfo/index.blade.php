@extends('admin.app')

@section('title')
    Dangerous Goods Add Info
@endsection
@section('page_title')
    <span class="text-semibold">Dangerous Goods Add Info</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th> Bahasa Indonesisa </th>
                        <th> English </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($infos as $info)
                    <tr>
                        <td> {{ $info->description }} </td>
                        <td> {{ $info->description_en }} </td>
                        <td>
                            <a href="{{ route('dangerousgoodsinfo.edit', $info->id) }}" class="btn btn-primary">
                                <i class="icon-pencil"></i> Edit
                            </a>
                        </td>
                @endforeach
                <tbody>
            </table>
        </div>
    </div>
@endsection