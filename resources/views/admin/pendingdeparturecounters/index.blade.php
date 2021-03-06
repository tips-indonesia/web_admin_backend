@extends('admin.app')

@section('title')
    Pending Package to Departure Counter
@endsection
@section('page_title')
<span class="text-semibold">Pending Package to Departure Counter</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        {{ Form::open(array('url' => route('pendingdeparturecounters.index'), 'method' => 'GET', 'id' => 'date_form')) }}
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
                            {{ $data->packaging_id }}
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
                            {{ $data->is_receive == 2? 'Taken' : 'Not Taken' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->appends(request()->input())->links() }}
    </div>
    <script type="text/javascript">
        
            $('.select-search').select2();
            $('.pickadate-year').datepicker({format: 'yyyy-mm-dd',});
           $('#param').on('select2:select', function() {
                if ($('#param').val() != 'blank') {
                    $('#value').prop('required', true)
                } else {
                    $('#value').prop('required', false)
                }
            });
    </script>

@endsection