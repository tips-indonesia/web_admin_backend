@extends('admin.app')

@section('title')
    Received by Processing Center
@endsection
@section('page_title')
    <span class="text-semibold">Received by Processing Center</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        {{ Form::open(array('url' => route('deliveries.index'), 'method' => 'GET', 'id' => 'date_form')) }}
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
                    <th>Shipment ID</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            {{ $data->shipment_id }}
                        </td>
                        <td>
                            {{ $data->status_name }}
                        </td>
                        <td>
                            {{ $data->status_name }}
                        </td>
                        <td>
                            {{ $data->status_name }}
                        </td>
                        <td>
                            @if ($data->id_shipment_status == 1 || $data->id_shipment_status == 2)
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'PUT', 'url' => route('receiveds.update', $data->id))) }}
                            <div class="text-right form-group">
                                <button type="submit"  class="btn btn-danger" style="vertical-align: middle;"><i class="icon-trash"></i> Received</button>
                            </div>
                            {{ Form::close() }}
                            </li>
                            </ul>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->links() }}
    </div>
    <script type="text/javascript">
            $('.select-search').select2();
        
    </script>
@endsection
