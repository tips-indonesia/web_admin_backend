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
                    <label>Delivery ID :</label>
                    <input type="text" class="form-control" value="{{$delivery->delivery_id}}" readonly disabled>
                </div>
            </div>

            <div class="col-md-6">
                <label>Receive Date : {{$delivery->received_by_pc_date}} </label><br>
                <label>Total Packaging : {{$delivery->arrivalShipmentDetail->count()}}</label><br><br>
                <label>Packaging List</label>

            </div>
            <table class="table datatable-pagination">
                <thead>
                    <tr>
                        <th> Package ID </th>
                        <th> Total Shipment </th>
                    </tr>
                </thead>
                    <tr>
                        @foreach($packages as $pack)
                        <td> 
                            <a data-toggle="collapse" data-target="#pack{{$pack->id}}">
                                {{$pack->packaging_id}} 
                            </a>
                        </td>
                        <td> {{count($pack->shipments)}} </td>
                    </tr>
                    <tr id="pack{{$pack->id}}" class="collapse">
                        <td colspan="2">
                                <table class="table datatable-pagination">
                                    <thead>
                                        <tr>
                                            <th>Shipment ID</th>
                                            <th>Date</th>
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Weight</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pack->shipments as $ship)
                                        <tr>
                                            <td>{{$ship->shipment_id}}</td>
                                            <td>{{$ship->transaction_date}}</td>
                                            <td>{{$ship->origin_city}}</td>
                                            <td>{{$ship->destination_city}}</td>
                                            <td>{{$ship->real_weight}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </td>
                    </tr>
                        @endforeach
                    </tr>
                <tbody>
                    
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