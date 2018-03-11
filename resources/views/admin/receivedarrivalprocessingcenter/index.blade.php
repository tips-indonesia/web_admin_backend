@extends('admin.app')

@section('title')
    Received by Arrival Processing Center
@endsection
@section('page_title')
    <span class="text-semibold">Received by Arrival Processing Center</span> - Show All
@endsection

@section('content')
    <div class="panel panel-flat">
    	{{ Form::open(array('url' => route('receivedarrivalprocessingcenter.index'), 'method' => 'GET', 'id' => 'date_form')) }}
            <div class="panel-body">
                <div class="form-group">
                    <label class="display-block text-semibold">Status Terima :</label>
                    <label class="radio-inline">
                        <input type="radio" name="radio" @if($checked == 0) checked="checked" @endif value="0">
                        Belum Diterima
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="radio" @if($checked == 1) checked="checked" @endif value="1">
                        Diterima
                    </label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Search By :</label>
                            <select name="param" id="param" class="select-search">
                                <option value="blank" @if($param =='blank' || $param=='') selected @endif>&#8192;</option>
                                <option value="delivery_id" @if($param =='delivery_id') selected @endif>Delivery ID</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>&#8192;</label>
                            <input type="text" name="value" id="value" class="form-control " placeholder="Search" value={{$value }}>                       
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
                    <th>Delivery ID</th>
                    <th>Delivery Date</th>
                    <th>Total Shipment</th>
                    <th>Status</th>
                    <th>Receive Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deliveries as $delivery)
                @if($delivery->is_received_by_pc == $checked || $checked == -1)
                <tr>
                	<td>
                        <a href="{{ route('receivedarrivalprocessingcenter.show', $delivery->arrival_shipment_id) }}">
                            {{$delivery->delivery_id}}
                        </a>
                    </td>
                	<td>{{$delivery->delivery_date}}</td>
                    <td>{{$delivery->total_shipment}}
                    <td>{{$delivery->is_received_by_pc == 0 ? 'Belum Diterima':'Sudah Diterima'}}</td>
                    <td>{{$delivery->received_by_pc_date}}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>  

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
    </script>
@endsection
