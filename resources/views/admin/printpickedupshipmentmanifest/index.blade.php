@extends('admin.app')

@section('title')
    Print Picked Up Shipment Manifest
@endsection
@section('page_title')
    <span class="text-semibold">Print Picked Up Shipment Manifest</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        {{ Form::open(array('url' => route('printpickedupshipmentmanifest.index'), 'method' => 'GET', 'id' => 'date_form')) }}
                    <div class="panel-body">
                <div class="form-group">
                    <label>Date :</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                        <input type="text" name="date" id="date" class="form-control pickadate-year" 
                            placeholder="Transaction date" value={{$date}}>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Search By :</label>
                            <select name="param" id="param" class="select-search">
                                <option value="blank" @if($param =='blank' || $param=='') selected @endif>&#8192;</option>
                                <option value="pickup_by" @if($param =='pickup_by') selected @endif>Worker Name</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>&#8192;</label>
                            <input type="text" name="value" id="value" class="form-control " placeholder="Search" value={{$value}}>                       
                        </div>
                    </div>
                </div>
                <div class=" form-group">
                    <button type="submit" class="btn btn-primary">View <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
            {{ Form::close() }}
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Worker Name</th>
                    <th>Office Name</th>
                    <th>Total Shipment</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($datas as $data)
            @if ($data->is_included)
                <tr>
                    <td>
                        <a href="{{ route('printpickedupshipmentmanifest.show', $data->pickup_by) }}?date={{$date}}">
                            {{ $data->name }}
                        </a>
                    </td>
                    <td>{{ $data->office_name }}</td>
                    <td>{{ $data->total_shipment }}</td>
                </tr>
            @endif
            @endforeach
            </tbody>
        </table>

    </div>

    <script type="text/javascript">
        $('.select-search').select2();
        $('.pickadate-year').datepicker({
            format: 'yyyy-mm-dd',
        });
        $('#param').on('select2:select', function() {
            if ($('#param').val() != 'blank') {
                if (($('#param').val() == 'received') || ($('#param').val() == 'not_received')) {
                    $('#value').prop('disabled', true);    
                } else {
                    $('#value').prop('disabled', false);
                    $('#value').prop('required', true)
                }
            } else {
                $('#value').prop('required', false)
            }
        });
        $(document).ready(function() {
            @if(session('received') !== null)
                window.alert("{{session('received')}}")      
            @endif
        })
    </script>
@endsection
