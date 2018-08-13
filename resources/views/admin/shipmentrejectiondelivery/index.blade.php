@extends('admin.app')

@section('title')
    Shipment Rejection Delivery
@endsection
@section('page_title')
<span class="text-semibold">Shipment Rejection Delivery</span> - Show All
@endsection
@section('content')
<div class="panel panel-flat">
<div class="panel-body">
{{ Form::open(array('url' => route('shipmentrejectiondelivery.index'), 'method' => 'GET', 'id' => 'date_form')) }}
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
                        <a href="{{ route('shipmentrejectiondelivery.show', $shipment->id) }}">
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
        {{$shipments->appends(request()->input())->links()}}
    </div>  

    </div>

    <div id="modal_small" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Pending Item</h5>
                    </div>

                    <div class="modal-body">
                            <div class="panel panel-flat">
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
                                        @foreach ($datas2 as $dat)
                                            <tr>
                                                <td>
                                                   {{ $dat->shipment_id }}
                                                </td>
                                                <td>
                                                    @if($dat->id_shipment_status == 12)
                                                    Belum Dikirim
                                                    @else
                                                    Sudah Dikirim
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$dat->nama_pengirim}}
                                                </td>
                                                <td>
                                                    @if($dat->id_shipment_status == 15)
                                                    Sudah Diterima
                                                    @else
                                                    Belum Diterima
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                            </div>
                    </div>

                    <div class="modal-footer">
                    </div>
                </div>
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