@extends('admin.app')

@section('title')
    Delivery Shipment
@endsection
@section('page_title')
    <span class="text-semibold">Delivery Shipment</span> - Show All
@endsection

@section('content')
    <div class="panel panel-flat">
        {{ Form::open(array('url' => route('deliveryshipment.index'), 'method' => 'GET', 'id' => 'date_form')) }}
            <div class="panel-body">
                <div class="form-group">
                    <label>Date :</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                        <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Transaction date" value="{{ $date }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="display-block text-semibold">Status :</label>
                    <label class="radio-inline">
                        <input type="radio" name="radio" @if($checked == 0) checked="checked" @endif value="0">
                        Belum Dikirim
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="radio" @if($checked == 1) checked="checked" @endif value="1">
                        Sudah Dikirim
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="radio" @if($checked != 0 && $checked != 1) checked="checked" @endif value="-1">
                        Keseluruhan
                    </label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Search By :</label>
                            <select name="param" id="param" class="select-search">
                                <option value="blank" @if($param =='blank' || $param=='') selected @endif>&#8192;</option>
                                <option value="shipment_id" @if($param =='shipment_id') selected @endif>Shipment ID</option>
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
                    <th>Shipment ID</th>
                    <th>Status Dikirim</th>
                    <th>Dikirim Oleh</th>
                    <th>Status Diterima</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shipments as $shipment)
                @if($shipment->is_included || $checked == -1)
                <tr>
                    <td>
                        <a href="{{ route('deliveryshipment.show', $shipment->id) }}">
                            {{$shipment->shipment_id}}
                        </a>
                    </td>
                    <td>
                        @if($shipment->id_shipment_status == 12)
                        Belum Dikirim
                        @else
                        Sudah Dikirim
                        @endif
                    </td>
                    <td>{{$shipment->nama_pengirim}}</td>
                    <td>
                        @if($shipment->id_shipment_status == 15)
                        Sudah Diterima
                        @else
                        Belum Diterima
                        @endif
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        {{$shipments->links()}}
    </div>  

    </div>
    <script type="text/javascript">
        var date = new Date();
        date.setDate(date.getDate() - 1);

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
