@extends('admin.app')

@section('title')
    Shipment Tracking Detail
@endsection
@section('page_title')
<span class="text-semibold">Shipment Tracking</span> - Detail
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Shipper Name :</label>
                                <input type="text" value="{{ $data->shipper_first_name.' '.$data->shipper_last_name }}" class="form-control" disabled readonly />
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Origin City :</label>
                                <input type="text" value="{{ $data->origin_city }}" class="form-control" disabled readonly />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Destination City :</label>
                                <input type="text" value="{{ $data->destination_city }}" class="form-control" disabled readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Consignee Name :</label>
                                <input type="text" value="{{ $data->consignee_first_name.' '.$data->consignee_last_name }}" class="form-control" disabled readonly />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Consignee Address :</label>
                                <input type="text" value="{{ $data->consignee_address }}" class="form-control" disabled readonly />
                            </div>
                        </div>
                    </div>
                    <legend class="text-bold">Tracking Details</legend>
                    <table class="table datatable-pagination">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Hour</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shipment_trackings as $shipment_tracking)
                                <tr>
                                    <td>
                                        {{ $shipment_tracking->created_at->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        {{ $shipment_tracking->created_at->format('H:i') }}
                                    </td>
                                    <td>
                                        {{ $shipment_status[$shipment_tracking->id_shipment_status]->description }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
@endsection