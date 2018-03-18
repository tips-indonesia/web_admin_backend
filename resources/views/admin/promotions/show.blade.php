@extends('admin.app')

@section('title')
    Promotion
@endsection
@section('page_title')
<span class="text-semibold">Promotions</span> - Show All
@endsection
@section('content')
        <table class="table datatable-pagination">
            <thead>
                <tr>    
                    <th>No</th>
                    <th>Tanggal Awal</th>
                    <th>Tanggal Akhir</th>
                    <th>Header Text</th>
                    <th>Template</th>
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
                            {{ $datas->start_date }}
                        </td>                        
                        <td>
                            {{ $datas->end_date }}
                        </td>
                        <td>
                            {{ $datas->header }}
                        </td>
                        <td>
                            {{ $datas->template_type }}
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