@extends('admin.app')

@section('title')
    Receive Packaging to Arrival Processing Center
@endsection
@section('page_title')
    <span class="text-semibold">Receive Packaging to Arrival Processing Center</span> - Show All
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('deliveryprocessingcenters.create') }}@if ($date != null)?date={{$date}}' @endif">Create</button>
    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal_small">Pending Item</i></button>
@endsection
@section('content')
    <div class="panel panel-flat">     
        {{ Form::open(array('url' => route('deliveryprocessingcenters.index'), 'method' => 'GET', 'id' => 'date_form')) }}
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
                                <option value="blank" @if($param =='blank' || $param=='') selected @endif>&#8192;</option>
                                <option value="delivery_id" @if($param =='delivery_id') selected @endif>Receive ID</option>
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
                    <th>Receive ID</th>
                    <th>Receive Time</th>
                    <th>Total Shipment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            <a href="{{ route('deliveryprocessingcenters.edit', $data->id) }}">
                            {{ $data->delivery_id }}
                            </a>
                        </td>
                        <td>
                            {{ $data->delivery_time }}
                        </td>
                        <td>
                            {{ $data->total }}
                        </td>
                        <td>
                            {{ $data->is_posted == 1 ? 'Submited' : 'Not Submited' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->links() }}
    </div>
    <!-- Small modal -->
        <div id="modal_small" class="modal fade">
            <div class="modal-dialog modal-sm">
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
                                            <th>Receive ID</th>
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Total Shipment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas2 as $data)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('packagingrestshipments.edit', $data->id) }}">
                                                        {{ $data->delivery_id }}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $data->total }}
                                                </td>
                                                <td>
                                                    {{ $data->origin }}
                                                </td>
                                                <td>
                                                    {{ $data->destination }}
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
        $('.select-search').select2();
        $('.pickadate-year').datepicker({
            format: 'yyyy-mm-dd',
        });
    </script>

@endsection