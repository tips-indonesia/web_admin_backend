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
                                <input type="text" value="{{ $data->shipper_name }}" class="form-control" disabled readonly />
                            </div>
                            <div class="form-group">
                                <label>Origin City :</label>
                                <input type="text" value="{{ $data->origin_city }}" class="form-control" disabled readonly />
                            </div>
                            <div class="form-group">
                                <label>Destination City :</label>
                                <input type="text" value="{{ $data->destination_city }}" class="form-control" disabled readonly />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Departure Date :</label>
                                <input type="text" value="" class="form-control" disabled readonly />
                            </div>
                            <div class="form-group">
                                <label>Departure Hour :</label>
                                <input type="text" value="" class="form-control" disabled readonly />
                            </div>
                            <div class="form-group">
                                <label>Arrival Hour :</label>
                                <input type="text" value="" class="form-control" disabled readonly />
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
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
@endsection