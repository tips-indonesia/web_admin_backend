@extends('admin.app')

@section('title')
    Pending Package at Arrival Counter
@endsection
@section('page_title')
<span class="text-semibold">Pending Package at Arrival Counter</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        {{ Form::open(array('url' => route('pendingarrivalcounters.index'), 'method' => 'GET', 'id' => 'date_form')) }}
                <div class="panel-body">
                <div class="form-group">
                    <label>Date :</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                        <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Transaction date" value="{{ $date }}">
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Search By :</label>
                        <select name="param" id="param" class="select-search">
                            <option value="blank" selected>&#8192;</option>
                            <option value="packaging_id" {{ $param == 'packaging_id' ? 'selected' : '' }}>Package ID</option>
                            
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>&#8192;</label>
                        <input type="text" name="value" id="value" class="form-control " placeholder="Search" value="{{$value}}">                       
                    </div>
                </div>
            </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">View <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
            {{ Form::close() }}

        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Packaging ID</th>
                    <th>Date</th>
                    <th>Slot Id</th>
                    <th>Original</th>
                    <th>Destination</th>
                    <th>Status</th>
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
                            {{ $data->created_at }}
                        </td>  
                        <td>
                            {{ $data->slot_id }}
                        </td>                        
                        <td>
                            {{ $data->origin_city }}
                        </td>                   
                        <td>
                            {{ $data->destination_city }}
                        </td>                   
                        <td>
                            {{ $data->id_slot_status == 5? 'Received' : 'Not Received' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->links() }}
    </div>
    <script type="text/javascript">
        
            $('.select-search').select2();
            $('.pickadate-year').datepicker({format: 'yyyy-mm-dd',});
    </script>

@endsection