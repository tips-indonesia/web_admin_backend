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
                    <th>No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php($nomor=0)
                @foreach($data as $datas)
                    <tr>
                        <td>
                            {{++$nomor}}
                        </td>
                        <td>
                            {{ $datas->title }}
                        </td>                        
                        <td>
                            {{ $datas->description }}
                        </td>
                        <td>
                            <img src="{{ URL::to('/') }}/storage/promotions/{{$datas->filename}}" style="height: 40px; width: 100px;">
                        </td>
                        <td>
                            {{ Form::open(array('method' => 'DELETE', 'url' => route('promotions.destroy', $datas->id))) }}
                                <button type="submit" class="btn btn-danger"><i class="icon-trash"></i> Delete</button>
                                {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
    <!-- Small modal -->

@endsection