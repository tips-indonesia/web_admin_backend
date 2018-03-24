@extends('admin.app')

@section('title')
    Received by Arrival Processing Center
@endsection
@section('page_title')
<span class="text-semibold">Received by Arrival Processing Center</span> - Detail
@endsection
@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Packaging ID :</label>
                    <input type="text" class="form-control" value="{{$package->packaging_id}}" readonly disabled>
                </div>
            </div>

            <div class="col-md-6">
                <label>Total Shipment : {{count($shipments)}}</label><br><br>
                <label>Shipment List</label>
            </div>

            <table class="table datatable-pagination">
                <thead>
                    <tr>
                        <th>Shipment ID</th>
                        <th>Date</th>
                        <th>Original</th>
                        <th>Destination</th>
                        <th>Weight</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shipments as $shipment)
                    <tr>
                        <td>{{$shipment->shipment_id}}</td>
                        <td>{{$shipment->transaction_date}}</td>
                        <td>{{$shipment->origin_city}}</td>
                        <td>{{$shipment->destination_city}}</td>
                        <td>{{$shipment->real_weight}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ Form::open(array('method' => 'PUT', 'url' => route('receivedarrivalprocessingcenter.update', $delivery->id))) }}
            <div class="text-right form-group">
                <button type="submit"  class="btn btn-danger" style="vertical-align: middle;" {{ $delivery->is_received_by_pc == 0 ? '':'disabled' }}><i class="icon-trash"
            ></i> Receive</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection